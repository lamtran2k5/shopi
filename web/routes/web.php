<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangePasswdController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\OrderHistoryController;

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
// Change Password
Route::get('/account/ChangePasswd', [ChangePasswdController::class, 'view'])->name('account.changePasswd')->middleware('auth');
Route::post('/account/ChangePasswd', [ChangePasswdController::class, 'changepasswd'])->name('account.upchangePasswd');
// info
Route::get('/account/info', [InfoController::class, 'view'])->name('account.info')->middleware('auth');
Route::post('/account/info', [InfoController::class, 'changeinfo'])->name('account.upinfo');
// Product 
Route::get('/product/{id}', [ProductController::class, 'view'])->name('product.detail');
// Wallet
Route::get('/account/Wallet', [WalletController::class, 'view'])->name('account.wallet');
Route::post('/account/Wallet', [WalletController::class, 'upwallet'])->name('account.wallet');
// Payment history
Route::get('/account/PaymentHistory', [PaymentHistoryController::class, 'index'])->name('account.paymenthistory');
// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('home.admin');
// Order history
Route::get('/account/OrderHistory', [OrderHistoryController::class, 'index'])->name('account.orderhistory');



