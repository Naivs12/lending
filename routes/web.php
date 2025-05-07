<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ClientPaymentController;
<<<<<<< HEAD
use App\Http\Controllers\ArchiveController;

=======
use App\Http\Controllers\BackupAndRestoreController;
>>>>>>> a07baa946ddf4aa5c05e3466bce334fc28d12382

use App\Http\Middleware\SystemAdminMiddleware;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/loan/loan', [LoanController::class, 'index_loan_admin'])->name('admin.loan.loan');
    Route::get('/admin/loan/release', [LoanController::class, 'index_release_admin'])->name('admin.loan.release');
    Route::get('/admin/loan/review', [LoanController::class, 'index_review_admin'])->name('admin.loan.review');
    Route::get('/admin/client', [ClientController::class, 'index_admin'])->name('admin.client');
    Route::get('/admin/investor', [InvestorController::class, 'index_investor'])->name('admin.investor');
    Route::get('/admin/payment_info/client', [ClientPaymentController::class, 'index'])->name('admin.payment_info.client_info');
    Route::get('/loan-detail/{loan_id}', [LoanController::class, 'show_loan_details'])->name('loan_detail');
});

Route::middleware([SystemAdminMiddleware::class])->group(function () {
    Route::get('/system-admin/maintenance/branch', [BranchController::class, 'index'])->name('system-admin.maintenance.branch');
    Route::post('/branch/submit', [BranchController::class, 'store']);
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
    Route::get('/system-admin/maintenance/users', [UserController::class, 'index'])->name('system-admin.maintenance.users');
    Route::post('/users/submit', [UserController::class, 'create_user'])->name('users.submit');
    Route::get('/users/edit/{id}', function ($id) {
        $user = User::find($id);
        if ($user) {
            return response()->json(['success' => true, 'user' => $user]);
        }
        return response()->json(['success' => false]);
    });
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete-user/{id}', [UserController::class, 'delete_user']);
    Route::get('/system-admin/client', [ClientController::class, 'index'])->name('system-admin.client');
    Route::get('/client-detail/{client_id}', [ClientController::class, 'show_client_details'])->name('client_detail');
    Route::delete('/delete-client/{id}', [ClientController::class, 'delete_client']);
    Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');
    Route::get('/system-admin/investor', [InvestorController::class, 'index'])->name('system-admin.investor');
    Route::get('/investor-detail/{investor_id}', [InvestorController::class, 'show_investor_details'])->name('investor_detail');
    Route::get('/system-admin/loan/loan', [LoanController::class, 'index_loan'])->name('system-admin.loan.loan');
    Route::get('/system-admin/loan/release', [LoanController::class, 'index_release'])->name('system-admin.loan.release');
    Route::get('/system-admin/loan/review', [LoanController::class, 'index_review'])->name('system-admin.loan.review');
    Route::get('/loan/search', [LoanController::class, 'search'])->name('loan.search');
    Route::get('/system-admin/payment_info/client', [ClientPaymentController::class, 'index_sysad'])->name('system-admin.payment_info.client_info');
    Route::get('/loan-detail/{loan_id}', [LoanController::class, 'show_loan_details_sysad'])->name('loan_detail');
    Route::get('system-admin/maintenance/archive', [ArchiveController::class, 'index'])->name('system-admin.maintenance.archive');
});

Route::post('/update-loan-status', [LoanController::class, 'updateStatus']);
Route::get('/clients/search', [LoanController::class, 'search'])->name('clients.search');
Route::get('/search/loans', [LoanController::class, 'search_loan'])->name('loans.search');
Route::middleware(['auth'])->group(function () {
    Route::post('/client/submit', [ClientController::class, 'store'])->name('client.submit');
    Route::post('/investor/submit', [InvestorController::class, 'add_investor'])->name('investor.submit');
});
<<<<<<< HEAD
Route::post('/loan/submit', [LoanController::class, 'create_loan'])->name('loan.submit');
Route::post('/client-payment/create', [ClientPaymentController::class, 'create_payment'])->name('client.payment.create');
Route::post('/blocklist-client/{id}', [ClientController::class, 'blocklist'])->name('client.blocklist');
=======

Route::post('/upload-image', [ClientController::class, 'upload'])->name('upload.image-client');

Route::get('/system-admin/maintenance/backup-and-restore', [BackupAndRestoreController::class, 'index'])->name('system-admin.maintenance.backup-and-restore');
Route::get('/system-admin/maintenance/backup', [BackupAndRestoreController::class, 'backup'])->name('system-admin.maintenance.backup');


>>>>>>> a07baa946ddf4aa5c05e3466bce334fc28d12382

