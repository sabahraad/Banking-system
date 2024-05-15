<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/users', [App\Http\Controllers\UserController::class, 'userCreateForm'])->name('userCreateForm');
Route::post('/users', [App\Http\Controllers\UserController::class, 'createUser'])->name('createUser');
Route::get('/login', [App\Http\Controllers\UserController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

Route::get('/deposit', [App\Http\Controllers\DepositController::class, 'depositList'])->name('depositList');
Route::post('/deposit', [App\Http\Controllers\DepositController::class, 'deposit'])->name('deposit');

Route::get('/withdrawal', [App\Http\Controllers\WithdrawalController::class, 'withdrawalList'])->name('withdrawalList');
Route::post('/withdrawal', [App\Http\Controllers\WithdrawalController::class, 'withdrawal'])->name('withdrawal');
});
