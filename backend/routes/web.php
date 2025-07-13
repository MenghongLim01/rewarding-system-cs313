<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/error', [IndexController::class, 'error'])->name('error');
    Route::get('/logout-loading', 'logoutLoading')->name('logout-loading');
    Route::get('/notification-page', 'notificationPage')->name('notification-page');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/reward', 'redeemReward')->name('reward');
    Route::get('/reward-history', 'redeemHistory')->name('reward-history');
    Route::get('/terms-and-conditions', 'termConditions')->name('terms-and-conditions');
    Route::get('/private-policy', 'privatePolicy')->name('privacy-policy');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

//     Route::middleware('auth:admin')->group(function () {
//         Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
//         Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
//         Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('admin.users');
//         Route::get('/manage-reward', [AdminController::class, 'managerReward'])->name('admin.rewards');
//         Route::get('/user-log', [AdminController::class, 'adminUserLog'])->name('admin.logs');
//         Route::get('/api-documentation', [AdminController::class, 'apiDocumentation'])->name('admin.api');
//         Route::get('/manage-staffs', [AdminController::class, 'manageStaffs'])->name('staffs');
//         Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
//     });
// });

/*
|--------------------------------------------------------------------------
| Misc Routes
|--------------------------------------------------------------------------
*/

Route::get('/process-customer-orders', [AdminController::class, 'processCustomerOrders'])->name('process-customer-orders');


// without Authentication

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('admin.users');
        Route::get('/manage-reward', [AdminController::class, 'managerReward'])->name('admin.rewards');
        Route::get('/user-log', [AdminController::class, 'adminUserLog'])->name('admin.logs');
        Route::get('/api-documentation', [AdminController::class, 'apiDocumentation'])->name('admin.api');
        Route::get('/manage-staffs', [AdminController::class, 'manageStaffs'])->name('staffs');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
});
