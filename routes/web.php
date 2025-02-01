<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\AdminController;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/admin/loan/loan', [AdminController::class, 'loan'])->name('admin.loan.loan');

Route::get('/admin/client', [AdminController::class, 'client'])->name('admin.client');

Route::get('/admin/investor', [AdminController::class, 'investor'])->name('admin.investor');

Route::get('/SystemAdminDashboard', [SystemAdminController::class, 'SystemAdminDashboard'])->name('system-admin.dashboard');

Route::get('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');