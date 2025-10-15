<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ReservationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['verified'])->name('dashboard');
//    admin routes
    Route::get('/admin/logout' , [AdminController::class , 'logout'])->name('admin.logout');
    Route::get('info' , [AdminController::class , 'info'])->name('info');

//    reservation route

    Route::get('reservation' , [ReservationController::class , 'index'])->name('reservation.index');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
