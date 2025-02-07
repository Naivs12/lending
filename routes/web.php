<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\AdminController;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/admin/loan/loan', [AdminController::class, 'loan'])->name('admin.loan.loan');

Route::get('/admin/loan/release', [AdminController::class, 'release'])->name('admin.loan.release');

Route::get('/admin/loan/review', [AdminController::class, 'review'])->name('admin.loan.review');

Route::get('/admin/client', [AdminController::class, 'client'])->name('admin.client');

Route::get('/admin/investor', [AdminController::class, 'investor'])->name('admin.investor');

Route::get('/SystemAdminDashboard', [SystemAdminController::class, 'SystemAdminDashboard'])->name('system-admin.dashboard');

Route::get('/admin/payment_info/client', [AdminController::class, 'payment_client'])->name('admin.payment_info.client_info');