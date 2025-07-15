<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.submit');
    
    Route::controller(UserController::class)->middleware(['auth:user'])->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
        // Add more routes here
        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('/history', [UserController::class, 'history'])->name('user.history');
    });


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('admin.users');
        Route::get('/manage-reward', [AdminController::class, 'managerReward'])->name('admin.rewards');
        Route::get('/user-log', [AdminController::class, 'adminUserLog'])->name('admin.logs');
        Route::get('/api-documentation', [AdminController::class, 'apiDocumentation'])->name('admin.api');
        Route::get('/manage-staffs', [AdminController::class, 'manageStaffs'])->name('staffs');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/transaction-history', [AdminController::class, 'transactionHistory'])->name('admin.transaction.history');

    });
});




/*
|--------------------------------------------------------------------------
| Misc Routes
|--------------------------------------------------------------------------
*/

Route::get('/process-customer-orders', [AdminController::class, 'processCustomerOrders'])->name('process-customer-orders');


// without Authentication

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::prefix('admin')->group(function () {
    //  Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    // Route::middleware('auth:admin')->group(function () {
Route::middleware(['auth:admin'])->group(function () {
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        Route::get('/manage-reward', [AdminController::class, 'managerReward'])->name('admin.rewards');
        Route::get('/user-log', [AdminController::class, 'adminUserLog'])->name('admin.logs');
        Route::get('/api-documentation', [AdminController::class, 'apiDocumentation'])->name('admin.api');
        Route::get('/manage-staffs', [AdminController::class, 'manageStaffs'])->name('staffs');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/setting', [AdminController::class, 'adminSettings'])->name('admin.setting');
        Route::post('/profile/upload', [AdminController::class, 'uploadProfileImage'])->name('admin.profile.upload');
        
        Route::get('/companies', [CompaniesController::class, 'index'])->name('admin.companies.index');
        Route::get('/companies/create', [CompaniesController::class, 'create'])->name('admin.companies.create');
        Route::post('/companies', [CompaniesController::class, 'store'])->name('admin.companies.store');
        Route::get('/companies/{company_id}/edit', [CompaniesController::class, 'edit'])->name('admin.companies.edit');
        Route::put('/companies/{company_id}', [CompaniesController::class, 'update'])->name('admin.companies.update');
        Route::delete('/companies/{company_id}', [CompaniesController::class, 'destroy'])->name('admin.companies.destroy');

        // Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        // Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('admin.users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/users/{user_id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{user_id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{user_id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');



});
      
    // });
});


