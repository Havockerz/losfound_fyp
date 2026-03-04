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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard Route
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/report/lost', [ItemReportController::class, 'lost'])
        ->name('report.lostitem');

    // Route for the Found Item page
    Route::get('/report/found', [ItemReportController::class, 'found'])->name('report.founditem');

    Route::get('/report', [ItemReportController::class, 'index'])->name('report.index');
    
    Route::post('/report/store', [ItemReportController::class, 'store'])->name('report.store');

    Route::get('/report/{id}', [ItemReportController::class, 'show'])->name('report.show');
    Route::get('/report/{id}/edit', [ItemReportController::class, 'edit'])->name('report.edit');
    Route::put('/report/{id}', [ItemReportController::class, 'update'])->name('report.update');

    Route::get('/found-items/{id}', [ItemReportController::class, 'foundView'])->name('report.foundview');
    Route::get('/found-items/{id}/edit', [ItemReportController::class, 'foundEdit'])->name('report.foundedit');
    Route::put('/found-items/{id}', [ItemReportController::class, 'update'])->name('report.update');

    Route::get('/profile-dashboard', function () {return view('profile.index', ['user' => auth()->user()]);
    })->name('profile.index');

    Route::get('/profile', [ProfileUserController::class, 'index'])->name('profile.index');    
    Route::get('/profile/edit', [ProfileUserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileUserController::class, 'destroy'])->name('profile.destroy');



});

require __DIR__.'/auth.php';
