<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('orders', OrderController::class);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
    Route::post('orders/{order}/payments', [PaymentController::class, 'process']);
});
