<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginAction']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/chart', [ReportController::class, 'chart']);

    Route::resources([
        '/users' => UserController::class,
        '/categories' => CategoryController::class,
        '/accounts' => AccountController::class,
    ]);
});
