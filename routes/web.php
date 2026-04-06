<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemReportController;
use App\Http\Controllers\ProfileUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware('auth')->group(function () {
    
    // Item Reporting Routes
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', [ItemReportController::class, 'index'])->name('index');
        Route::get('/lost', [ItemReportController::class, 'lost'])->name('lostitem');
        Route::get('/found', [ItemReportController::class, 'found'])->name('founditem');
        Route::post('/store', [ItemReportController::class, 'store'])->name('store');
        
        // Use {item} for scoped bindings instead of {id} to match standard Controller methods
        Route::get('/{item}', [ItemReportController::class, 'show'])->name('show');
        Route::get('/{item}/edit', [ItemReportController::class, 'edit'])->name('edit');
        Route::put('/{item}', [ItemReportController::class, 'update'])->name('update');
    });

    // Found Items Specific View/Edit
    Route::get('/found-items/{item}/view', [ItemReportController::class, 'foundView'])->name('report.foundview');
    Route::get('/found-items/{item}/edit', [ItemReportController::class, 'foundEdit'])->name('report.foundedit');

    // User Profile Dashboard
    Route::get('/profile-dashboard', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileUserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileUserController::class, 'destroy'])->name('profile.destroy');
});

// --- ADMIN ONLY ROUTES ---
    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'userManagement'])->name('usermanagement');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('user.destroy');

    // Post Management
    Route::get('/post-management', [ItemReportController::class, 'allPosts'])->name('postmanagement');
});

require __DIR__.'/auth.php';