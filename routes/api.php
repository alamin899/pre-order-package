<?php

use Illuminate\Support\Facades\Route;
use PreOrder\PreOrderBackend\Http\Controllers\API\ProductListController;
use PreOrder\PreOrderBackend\Http\Controllers\API\StorePreOrderController;

Route::group([], function () {
    Route::get('products', ProductListController::class);
    Route::post('pre-order', StorePreOrderController::class)->middleware('throttle:10,1');
});

