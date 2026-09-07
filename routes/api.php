<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TypeAccountController;
use App\Http\Controllers\Api\FinancialTransactionController;
use App\Http\Controllers\Api\DashboardController;

use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::resource('type-accounts', TypeAccountController::class)->except(['create', 'edit']);
    Route::resource('financial-transactions', FinancialTransactionController::class)->except(['create', 'edit', 'show']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/report', [DashboardController::class, 'report']);
});
