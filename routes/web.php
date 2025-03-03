<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/admin/loan/loan', [AdminController::class, 'loan'])->name('admin.loan.loan');

Route::get('/admin/loan/release', [AdminController::class, 'release'])->name('admin.loan.release');

Route::get('/admin/loan/review', [AdminController::class, 'review'])->name('admin.loan.review');

Route::get('/admin/client', [AdminController::class, 'client'])->name('admin.client');

Route::get('/admin/investor', [AdminController::class, 'investor'])->name('admin.investor');

Route::get('/admin/payment_info/client', [AdminController::class, 'payment_client'])->name('admin.payment_info.client_info');

Route::get('/admin/payment_info/investor', [AdminController::class, 'payment_investor'])->name('admin.payment_info.investor_info');

// System ADmin

Route::get('/system-admin/loan/loan', [SystemAdminController::class, 'loan'])->name('system-admin.loan.loan');

Route::get('/system-admin/loan/release', [SystemAdminController::class, 'release'])->name('system-admin.loan.release');

Route::get('/system-admin/loan/review', [SystemAdminController::class, 'review'])->name('system-admin.loan.review');

Route::get('/system-admin/client', [SystemAdminController::class, 'client'])->name('system-admin.client');

Route::get('/system-admin/investor', [SystemAdminController::class, 'investor'])->name('system-admin.investor');

Route::get('/system-admin/payment_info/client', [SystemAdminController::class, 'payment_client'])->name('system-admin.payment_info.client_info');

Route::get('/system-admin/payment_info/investor', [SystemAdminController::class, 'payment_investor'])->name('system-admin.payment_info.investor_info');

Route::get('/system-admin/maintenance/users', [SystemAdminController::class, 'users'])->name('system-admin.maintenance.users');

Route::get('/system-admin/maintenance/branch', [BranchController::class, 'index'])->name('system-admin.maintenance.branch');

// Branch

Route::post('/branch/store', [BranchController::class, 'store']);
Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');


