<?php

use Illuminate\Support\Facades\Route;

#User Routes
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/dashboard', [App\Http\Controllers\IndexController::class, 'dashboard'])->name('dashboard');
Route::get('/error', [App\Http\Controllers\IndexController::class, 'error'])->name('error');
Route::get('/logout-loading', [App\Http\Controllers\IndexController::class, 'logoutLoading'])->name('logout-loading');
Route::get('/notification-page', [App\Http\Controllers\IndexController::class, 'notificationPage'])->name('notification-page');
Route::get('/profile', [App\Http\Controllers\IndexController::class, 'profile'])->name('profile');
Route::get('/reward', [App\Http\Controllers\IndexController::class, 'redeemReward'])->name('reward');
Route::get('/reward-history', [App\Http\Controllers\IndexController::class, 'redeemHistory'])->name('reward-history');
Route::get('/terms-and-conditions', [App\Http\Controllers\IndexController::class, 'termConditions'])->name('terms-and-conditions');
Route::get('/private-policy', [App\Http\Controllers\IndexController::class, 'privatePolicy'])->name('privacy-policy');




Route::get('/login', [App\Http\Controllers\IndexController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\IndexController::class, 'register'])->name('register');



#Admin Routes

# Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'adminSettings'])->name('admin.settings');
    Route::get('/manage-user', [App\Http\Controllers\AdminController::class, 'manageUser'])->name('admin.users');
    Route::get('/manage-reward', [App\Http\Controllers\AdminController::class, 'managerReward'])->name('admin.rewards');
    Route::get('/user-log', [App\Http\Controllers\AdminController::class, 'adminUserLog'])->name('admin.logs');
    Route::get('/api-documentation', [App\Http\Controllers\AdminController::class, 'apiDocumentation'])->name('admin.api');
});
