<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

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
Route::get('/account', [AccountController::class, 'index'])->name('home.account');
Route::get('/account/info', [AccountController::class, 'info'])->name('account.info');
Route::get('/account/address', [AccountController::class, 'address'])->name('account.address');
Route::get('/account/forget-password', [AccountController::class, 'forgetPassword'])->name('account.forgetPassword');
Route::get('/account/order-history', [AccountController::class, 'orderHistory'])->name('account.orderHistory');
// Logout