<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,SallerController};

// Admin routes
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class,'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class,'Login'])->name('admin.login');

    Route::get('/singup',[AdminController::class,'Singup'])->name('admin.singup');
    Route::post('/singup/owner',[AdminController::class,'Register'])->name('admin.register');

    Route::middleware('admin')->group(function(){
        Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard');
        Route::get('/logout',[AdminController::class,'Logout'])->name('admin.logout');
    });
});

// End of Admin routes

// Saller routes
Route::prefix('saller')->group(function(){
    Route::get('/login',[SallerController::class,'Index'])->name('saller_login_form');
    Route::post('/login/owner',[SallerController::class,'Login'])->name('saller.login');

    Route::get('/singup',[SallerController::class,'Singup'])->name('saller.singup');
    Route::post('/singup/owner',[SallerController::class,'Register'])->name('saller.register');

    Route::middleware('saller')->group(function(){
        Route::get('/dashboard',[SallerController::class,'Dashboard'])->name('saller.dashboard');
        Route::get('/logout',[SallerController::class,'Logout'])->name('saller.logout');
    });
});

// End of Saller routes

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Normal user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// End Normal user route

require __DIR__.'/auth.php';