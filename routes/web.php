<?php

use Illuminate\Support\Facades\Route;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Auth\LoginController;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Auth\LogoutController;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Auth\ShowLoginController;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard\DashboardController;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard\PreOrderListController;
use PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard\ProductListController;

Route::group([], function () {
    Route::middleware(['custom-guest'])->group(function () {
        Route::get('login', ShowLoginController::class)->name('auth.login');
        Route::post('login', LoginController::class)->name('auth.login.store');
    });

    Route::middleware(['custom-auth'])->group(function () {
        Route::post('logout', LogoutController::class)->name('auth.logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::get('products', ProductListController::class)->name('dashboard.products');
        Route::get('preorders', PreOrderListController::class)->name('dashboard.preorders');
    });
});