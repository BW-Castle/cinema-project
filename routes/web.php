<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Публичная часть
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Аутентификация
Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Личный кабинет
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/tickets/{ticket}', [UserController::class, 'showTicket'])->name('user.ticket');
});

// Админка
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/panel', [AdminController::class, 'panel'])->name('dashboard');
    //Route::get('/halls',
    //Route::get('/movies', 
    //Route::get('/screenings', 
    //Route::get('/tickets',
});