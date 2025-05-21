<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Blogs;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Blogs routes
    Route::get('/blogs', [Blogs::class, 'index']);
    Route::get('/blogs/{id}', [Blogs::class, 'show']);
    Route::post('/blogs', [Blogs::class, 'store']);
    Route::put('/blogs/{id}', [Blogs::class, 'update']);
    Route::delete('/blogs/{id}', [Blogs::class, 'destroy']);
});

