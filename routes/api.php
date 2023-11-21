<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signin', [AuthController::class, 'loginUser']);
Route::post('signup', [AuthController::class, 'register']);
Route::post('/forgot-password', [ResetPasswordController::class, 'sendOTPRequest'])->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
Route::post('/email/resend', [VerificationController::class, 'sendOTPRequest'])->name('verification.resend');
Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify');



Route::middleware(['auth:sanctum', 'emailVerified'])->group(function () {
    Route::get('product/{product_uuid}', [ProductController::class, 'productById']);
    Route::post('logout', [AuthController::class, 'logout']);
});
