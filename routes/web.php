<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\RegistrationController;

// Home page
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/track', [HomeController::class, 'track'])->name('track');
Route::get('/how-to', [HomeController::class, 'how'])->name('how');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::match(['get', 'post'], 'package', [HomeController::class, 'viewPackage'])->name('package');

// Registration routes (public)
Route::get('register', [RegistrationController::class, 'create'])->name('register');
Route::post('register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('register/generate-tracking', [RegistrationController::class, 'generateTrackingNumber'])->name('register.generate-tracking');

// Authenticated routes
Route::middleware(['activated'])->group(function () {
    Route::post('/process-name', [AuthController::class, 'processName'])->name('process.name');
    Route::get('/loading/{user}', [AuthController::class, 'showLoading'])->name('loading');
    Route::get('/name-input/{access_code}', [AuthController::class, 'showNameInput'])->name('name.input');
    Route::get('/verify-user/{user_id}/{status}', [AuthController::class, 'verifyUser'])
        ->name('verify.user');
    Route::get('/check-back-later', [AuthController::class, 'checkBackLater'])->name('check.back.later');
    Route::get('/check-status', [AuthController::class, 'checkStatus'])->name('check.status');
    Route::get('/payment-portal', [AuthController::class, 'showPaymentPortal'])->name('payment.portal');
});

Route::get('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\Auth\ManageUserController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [App\Http\Controllers\Auth\ManageUserController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/dashboard/analytics', [App\Http\Controllers\Auth\ManageUserController::class, 'getAnalytics'])
        ->name('admin.dashboard.analytics');

    Route::get('/packages', [App\Http\Controllers\ManagePackageController::class, 'index'])->name('admin.packages.index');
    Route::get('/packages-show', [App\Http\Controllers\ManagePackageController::class, 'showIndex'])->name('admin.packages.show.index');
    Route::get('/packages/create', [App\Http\Controllers\ManagePackageController::class, 'create'])->name('admin.packages.create');
    Route::post('/packages', [App\Http\Controllers\ManagePackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/packages/{package}/edit', [App\Http\Controllers\ManagePackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/packages/{package}', [App\Http\Controllers\ManagePackageController::class, 'update'])->name('admin.packages.update');
    Route::get('/packages/{package}', [App\Http\Controllers\ManagePackageController::class, 'show'])->name('admin.packages.show');
    Route::delete('/packages/{package}', [App\Http\Controllers\ManagePackageController::class, 'destroy'])->name('admin.packages.destroy');
    Route::post('/packages/{package}/send-email', [App\Http\Controllers\ManagePackageController::class, 'sendEmail'])->name('admin.packages.send-email');
    Route::get('/send-email', [App\Http\Controllers\ManagePackageController::class, 'sendEmailIndex'])->name('admin.packages.send-email.index');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.change-password');
    Route::put('/{admin}/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password.post');
});
