<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(
    function(){
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'actionLogin'])->name('login.action');
        Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
        Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.post');
    }
);

Route::middleware(['auth'])->group(
    function(){
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user/{id}', [ProfileController::class, 'index'])->name('profile');
        Route::get('/complaint/{id}/detail', [ComplaintDetailController::class, 'index'])->name('complaint.detail');
        Route::post('/complaint/{id}/response', [ComplaintDetailController::class, 'addResponse'])->name('response.add');
    }
);

Route::middleware(['auth', 'user-access:admin'])->group(
    function(){
        Route::get('/complaint/{id}', [DashboardController::class, 'editStatus'])->name('complaint.update');
    }
);

Route::middleware(['auth', 'user-access:user'])->group(
    function(){
        Route::get('/complaint', [ComplaintController::class, 'index'])->name('complaint');
        Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.post');
    }
);