<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAboutController;
use App\Http\Controllers\Api\ApiNewsController;
use App\Http\Controllers\Api\ApiGalleryController;
use App\Http\Controllers\Api\ApiMapController;
use App\Http\Controllers\Api\ApiContactController;

Route::prefix('v1')->group(function () {
    // Public APIs untuk mobile app
    Route::get('/about', [ApiAboutController::class, 'index']);
    Route::get('/news', [ApiNewsController::class, 'index']);
    Route::get('/news/{id}', [ApiNewsController::class, 'show']);
    Route::get('/gallery', [ApiGalleryController::class, 'index']);
    Route::get('/maps', [ApiMapController::class, 'index']);
    Route::post('/contact', [ApiContactController::class, 'store']);
});