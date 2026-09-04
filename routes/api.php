<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TypeAccountController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::resource('type-accounts', TypeAccountController::class)->except(['create', 'edit']);
});
