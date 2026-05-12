<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemReportController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\DashboardController;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {return view('welcome');})->name('landing');

//Merging login and register page into one route for better UI/UX
Route::get('/auth', function () {return view('auth.merge');})->name('auth.page');


// your merged login/register page
Route::get('/auth', function () {

    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('auth.merge');

})->name('auth.merge');


Route::get('/my-items', [ItemReportController::class, 'userItems'])->name('item.my_item'); 

// --- PUBLIC ROUTES ---
Route::get('/preview', function () {

    $stats = [
        'lost' => Item::where('type', 'lost')->count(),
        'found' => Item::where('type', 'found')->count(),
        'recovered' => Item::where('status', 'recovered')->count(),
    ];

    $recent = Item::orderBy('reported_date', 'desc')->take(5)->get();

    $monthly = Item::select(
        DB::raw("MONTH(reported_date) as month"),
        DB::raw("SUM(CASE WHEN type='lost' THEN 1 ELSE 0 END) as lost"),
        DB::raw("SUM(CASE WHEN type='found' THEN 1 ELSE 0 END) as found")
    )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return view('preview.dashboard', compact('stats', 'recent', 'monthly'));

})->name('preview.dashboard');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware('auth')->group(function () {

    // Item Reporting Routes
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', [ItemReportController::class, 'index'])->name('index');
        Route::get('/lost', [ItemReportController::class, 'lost'])->name('lostitem');
        Route::get('/found', [ItemReportController::class, 'found'])->name('founditem');
        Route::post('/store', [ItemReportController::class, 'store'])->name('store');
        Route::get('/found-report', [ItemReportController::class, 'foundIndex'])->name('foundindex');
        Route::post('/found-report/store', [ItemReportController::class, 'storeFound'])->name('foundstore');

        // Use {item} for scoped bindings instead of {id} to match standard Controller methods
        Route::get('/{item}', [ItemReportController::class, 'show'])->name('show');
        Route::get('/{item}/edit', [ItemReportController::class, 'edit'])->name('edit');
        Route::put('/{item}', [ItemReportController::class, 'update'])->name('update');
    });

    // Found Items Specific View/Edit
    Route::get('/found-items/{item}/view', [ItemReportController::class, 'foundView'])->name('report.foundview');
    Route::get('/found-items/{item}/edit', [ItemReportController::class, 'foundEdit'])->name('report.foundedit');
    Route::delete('/report/{item}', [ItemReportController::class, 'destroy'])->name('report.destroy');

    // Route to show the claim form/page 
    Route::get('/items/{item}/claim', [ItemReportController::class, 'claim'])->name('items.claim')->middleware(['auth']);


    // Route to handle the form submission 
    Route::post('/items/{item}/claim', [ItemReportController::class, 'storeClaim'])->name('items.claim.store')->middleware(['auth']);

    // The page to show the form 
    Route::get('/item/{item}/found', [ItemReportController::class, 'founditem'])->name('item.found')->middleware(['auth']);

    // The action to save the form 
    Route::post('/item/{item}/found', [ItemReportController::class, 'storeFoundItem'])->name('item.found.store')->middleware(['auth']);

    // User Profile Dashboard
    Route::get('/profile-dashboard', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileUserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileUserController::class, 'destroy'])->name('profile.destroy');

});

// --- ADMIN ONLY ROUTES ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/requests', [AdminController::class, 'manageRequests'])->name('requests');
    Route::patch('/claims/{id}/approve', [AdminController::class, 'approveClaim'])->name('claims.approve');
    Route::patch('/claims/{id}/reject', [AdminController::class, 'rejectClaim'])->name('claims.reject');

    // New Found Report Routes 
    Route::patch('/found-reports/{id}/approve', [AdminController::class, 'approveFound'])->name('found.approve');
    Route::patch('/found-reports/{id}/reject', [AdminController::class, 'rejectFound'])->name('found.reject');

    // User Management
    Route::get('/users', [AdminController::class, 'userManagement'])->name('usermanagement');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('user.destroy');

    // Post Management
    Route::get('/post-management', [ItemReportController::class, 'allPosts'])->name('postmanagement');
});

require __DIR__ . '/auth.php';