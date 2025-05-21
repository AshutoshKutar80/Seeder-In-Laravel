<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//register 
Route::get('/', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

//login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//dashboard
Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
Route::get('/customer/dashboard', [AuthController::class, 'customerDashboard']);
Route::post('/admin/toggleApproval/{id}', [AuthController::class, 'toggleApproval'])->name('admin.toggleApproval');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');