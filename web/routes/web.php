<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangePasswdController;

// Trang Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Account
Route::get('/account', [AvatarController::class, 'index'])->middleware('auth')->name('home.account');
//Avatar
Route::get('/account/Avatar', [AvatarController::class, 'view'])->name('account.avatar')->middleware('auth');
Route::post('/account/Avatar', [AvatarController::class, 'upload'])->name('account.upavatar');

Route::get('/account/ChangePasswd', [ChangePasswdController::class, 'view'])->name('account.changePasswd')->middleware('auth');
Route::post('/account/ChangePasswd', [ChangePasswdController::class, 'changepasswd'])->name('account.upchangePasswd');
// Logout