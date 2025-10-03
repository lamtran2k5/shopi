<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// Trang Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Trang About
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
