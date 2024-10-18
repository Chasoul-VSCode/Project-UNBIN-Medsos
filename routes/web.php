<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;

// register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);


// dashboard
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
