<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ReservationController;
use App\Http\Controllers\Consulter\ConsulterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/consulter/login', [\App\Http\Controllers\Consulter\auth\ConsulterLoginController::class, 'showLoginForm'])->name('consulter.login');
Route::post('/consulter/login', [\App\Http\Controllers\Consulter\auth\ConsulterLoginController::class, 'login']);


Route::get('register-consulter' , [\App\Http\Controllers\Consulter\auth\RegisterController::class , 'create'])->name('consulter.register');
Route::post('register-consulter' , [\App\Http\Controllers\Consulter\auth\RegisterController::class , 'register']);



//routes for consulter

Route::middleware('consulter_middleware')->group(function () {

    Route::get('/consulter/logout' , [ConsulterController::class , 'logout'])->name('consulter.logout');

    Route::get('consulter/index1', [ConsulterController::class, 'index'])->name('consulter.index');
    Route::get('reservation-check' , [ConsulterController::class , 'reservationCheck'])->name('check.reservation');
    Route::get('consulter-info' , [ConsulterController::class , 'consulterInfo'])->name('consulter.info');
});









// routes for user


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->middleware(['verified'])->name('dashboard');
//    user routes
    Route::get('/user/logout' , [AdminController::class , 'logout'])->name('user.logout');
    Route::get('info' , [AdminController::class , 'info'])->name('info');

//    reservation route
    Route::get('reservation' , [ReservationController::class , 'index'])->name('reservation.index');
    Route::post('reservation-store' , [ReservationController::class , 'store'])->name('reservation.store');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
