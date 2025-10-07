<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Middleware\Authenticate;

// Trang Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Trang About
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Account
Route::get('/account', [AccountController::class, 'index'])->middleware('auth')->name('home.account');
Route::post('/account', [AccountController::class, 'upload'])->name('account.upload');

// Logout