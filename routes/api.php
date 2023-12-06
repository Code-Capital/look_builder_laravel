<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\SavedItemController;
use App\Http\Controllers\Api\ShopController;
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

Route::get('categories', [ShopController::class, 'categories']);
Route::get('products/{category_uuid}', [ShopController::class, 'productsByCategory']);
Route::get('product/{product_uuid}', [ShopController::class, 'productById']);

Route::get('models', [ShopController::class, 'getModels']);
Route::get('fabrics', [ShopController::class, 'fabrics']);
Route::get('suits', [ShopController::class, 'suits']);
Route::get('suit/{suit_uuid}', [ShopController::class, 'suitById']);

Route::prefix('custom_products')->group(function () {
    Route::get('', [CustomProductController::class, 'getAllCustomProducts']);
    Route::get('{product_uuid}', [CustomProductController::class, 'getProductById']);
});

Route::middleware(['auth:sanctum', 'emailVerified'])->group(function () {

    Route::prefix('saved_item')->group(function () {
        Route::post('add', [SavedItemController::class, 'add']);
        Route::get('', [SavedItemController::class, 'getSavedItems']);
        Route::post('delete/{item_uuid}', [SavedItemController::class, 'removeFromSaveItem']);
    });

    Route::get('shop_look/{productIds}', [ShopController::class, 'shopLook']);


    Route::post('cart/{productIds}', [ShopController::class, 'myCart']);
    Route::post('add_size', [ShopController::class, 'addSize']);
    Route::get('view/cart', [ShopController::class, 'viewCart']);
    Route::post('remove_item/{product_id}', [ShopController::class, 'removeItemFromCart']);
    Route::get('sizes/{product_uuid}', [ShopController::class, 'getSizes']);
    Route::post('select_size', [ShopController::class, 'selectSizes']);
    Route::post('checkout', [ShopController::class, 'checkout']);
    Route::post('logout', [AuthController::class, 'logout']);
});
