<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvestorController;

use App\Http\Middleware\SystemAdminMiddleware;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::middleware([AdminMiddleware::class])->group(function () {
Route::get('/admin/loan/loan', [AdminController::class, 'loan'])->name('admin.loan.loan');

Route::get('/admin/loan/release', [AdminController::class, 'release'])->name('admin.loan.release');

Route::get('/admin/loan/review', [AdminController::class, 'review'])->name('admin.loan.review');

Route::get('/admin/client', [AdminController::class, 'client'])->name('admin.client');

Route::get('/admin/investor', [AdminController::class, 'investor'])->name('admin.investor');

Route::get('/admin/payment_info/client', [AdminController::class, 'payment_client'])->name('admin.payment_info.client_info');

Route::get('/admin/payment_info/investor', [AdminController::class, 'payment_investor'])->name('admin.payment_info.investor_info');

});
// System ADmin


Route::middleware([SystemAdminMiddleware::class])->group(function () {
Route::get('/system-admin/loan/loan', [SystemAdminController::class, 'loan'])->name('system-admin.loan.loan');

Route::get('/system-admin/loan/release', [SystemAdminController::class, 'release'])->name('system-admin.loan.release');

Route::get('/system-admin/loan/review', [SystemAdminController::class, 'review'])->name('system-admin.loan.review');


Route::get('/system-admin/investor', [SystemAdminController::class, 'investor'])->name('system-admin.investor');

Route::get('/system-admin/payment_info/client', [SystemAdminController::class, 'payment_client'])->name('system-admin.payment_info.client_info');

Route::get('/system-admin/payment_info/investor', [SystemAdminController::class, 'payment_investor'])->name('system-admin.payment_info.investor_info');

Route::get('/system-admin/maintenance/users', [SystemAdminController::class, 'users'])->name('system-admin.maintenance.users');

Route::get('/system-admin/client-detail', [SystemAdminController::class, 'client_detail'])->name('system-admin.client-detail');
Route::get('/system-admin/investor-detail', [SystemAdminController::class, 'investor_detail'])->name('system-admin.investor-detail');

// Branch
Route::get('/system-admin/maintenance/branch', [BranchController::class, 'index'])->name('system-admin.maintenance.branch');
Route::post('/branch/submit', [BranchController::class, 'store']);
Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');

//user
Route::get('/system-admin/maintenance/users', [UserController::class, 'index'])->name('system-admin.maintenance.users');

//add user
Route::post('/users/submit', [UserController::class, 'create_user'])->name('users.submit');

//edit user
Route::get('/users/edit/{id}', function ($id) {
    $user = User::find($id);
    if ($user) {
        return response()->json(['success' => true, 'user' => $user]);
    }
    return response()->json(['success' => false]);
});
Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/delete-user/{id}', [UserController::class, 'delete_user']);

//client
Route::get('/system-admin/client', [ClientController::class, 'index'])->name('system-admin.client');

//add client
Route::middleware(['auth'])->group(function () {
    Route::post('/client/submit', [ClientController::class, 'store'])->name('client.submit');
});


Route::get('/client-detail/{client_id}', [ClientController::class, 'show_client_details'])->name('client_detail');
Route::delete('/delete-client/{id}', [ClientController::class, 'delete_client']);

//edit client
Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');

Route::get('/system-admin/investor', [InvestorController::class, 'index'])->name('system-admin.investor');
Route::post('/investor/submit', [InvestorController::class, 'add_investor'])->name('investor.submit');


Route::get('/investor-detail/{investor_id}', [InvestorController::class, 'show_investor_details'])->name('investor_detail');
});






