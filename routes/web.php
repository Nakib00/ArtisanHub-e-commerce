<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, categoryController, SallerController, webappController,sallerInfoController, shopController};

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');

    Route::get('/singup', [AdminController::class, 'Singup'])->name('admin.singup');
    Route::post('/singup/owner', [AdminController::class, 'Register'])->name('admin.register');

    //Admin middleware routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'Logout'])->name('admin.logout');

        //Dashboard routes Group of admin
        Route::prefix('/dashboard')->group(function () {
            // Category routes group
            Route::prefix('/category')->group(function () {
                Route::get('', [categoryController::class, 'category'])->name('admin.category');
                Route::post('/add', [categoryController::class, 'categoryStore'])->name('admin.category.add');
                Route::get('/{id}/status/change/{status}', [categoryController::class, 'changeStatus'])->name('admin.category.status');
                Route::get('/{id}/edit', [categoryController::class, 'editpage'])->name('admin.category.edit');
                Route::put('/{id}/update', [categoryController::class, 'updateCategory'])->name('admin.category.update');
                Route::delete('/{id}/delete', [categoryController::class, 'delete'])->name('admin.category.delete');
            });
        });
    });
});

// End of Admin routes

// Saller routes
Route::prefix('saller')->group(function () {
    Route::get('/login', [SallerController::class, 'Index'])->name('saller_login_form');
    Route::post('/login/owner', [SallerController::class, 'Login'])->name('saller.login');

    Route::get('/singup', [SallerController::class, 'Singup'])->name('saller.singup');
    Route::post('/singup/owner', [SallerController::class, 'Register'])->name('saller.register');

    Route::middleware('saller')->group(function () {
        Route::get('/dashboard', [SallerController::class, 'Dashboard'])->name('saller.dashboard');
        Route::get('/logout', [SallerController::class, 'Logout'])->name('saller.logout');

        //Dashboard routes Group of saller
        Route::prefix('/dashboard')->group(function () {
            // Category routes group
            Route::prefix('/category')->group(function () {
                Route::get('', [categoryController::class, 'categorysaller'])->name('saller.category');
                Route::post('/add', [categoryController::class, 'categoryStore'])->name('saller.category.add');
                Route::get('/{id}/status/change/{status}', [categoryController::class, 'changeStatus'])->name('saller.category.status');
                Route::get('/{id}/edit', [categoryController::class, 'editpage'])->name('admin.category.edit');
                Route::put('/{id}/update', [categoryController::class, 'updateCategory'])->name('saller.category.update');
                Route::delete('/{id}/delete', [categoryController::class, 'delete'])->name('saller.category.delete');
            });
            // shop routes group
            Route::prefix('/shop')->group(function () {
                Route::resource('shops', shopController::class);
            });

            Route::resource('sallerinfo', sallerInfoController::class);
        });
    });
});

// End of Saller routes

// Wab app routes
Route::prefix('/')->group(function () {
    Route::get('', [webappController::class, 'Index'])->name('index');
});
// End wab app routes

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

require __DIR__ . '/auth.php';
