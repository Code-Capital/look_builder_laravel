<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Custom\SortingController;
use App\Http\Controllers\Api\CustomProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\SavedItemController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Web\Custom\SuitController;
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
// Route::post('/email/resend', [VerificationController::class, 'sendOTPRequest'])->name('verification.resend');
// Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('categories', [ShopController::class, 'categories']);
Route::get('products/{category_uuid}', [ShopController::class, 'productsByCategory']);
Route::get('product/{product_uuid}', [ShopController::class, 'productById']);

Route::get('models', [ShopController::class, 'getModels']);
Route::get('suits', [ShopController::class, 'suits']);
Route::get('suit/{suit_uuid}', [ShopController::class, 'suitById']);


Route::get('fabrics', [ShopController::class, 'fabrics']);
Route::get('custom_suit/{uuid}', [SuitController::class, 'getSuitById']);
Route::get('custom_suits', [SuitController::class, 'customSuits']);
Route::prefix('custom_products')->group(function () {
    Route::get('', [CustomProductController::class, 'getAllCustomProducts']);
    Route::get('{product_uuid}', [CustomProductController::class, 'getProductById']);
    Route::get('getLayerImage/{product_uuid}/{fabric_uuid}', [CustomProductController::class, 'getLayerImageByFabric']);
    Route::get('option_by_id/{option_uuid}/{fabric_uuid}', [CustomProductController::class, 'getOptionById']);
});

Route::get('newest_first', [ShopController::class, 'newestFirst']);
Route::get('price_low_to_high', [ShopController::class, 'lowToHigh']);
Route::get('price_high_to_low', [ShopController::class, 'highToLow']);
Route::get('products_by_color', [ShopController::class, 'byColor']);
Route::get('initial_look', [ShopController::class, 'initialLook']);

Route::get('fabric_newest_first', [SortingController::class, 'newest_first']);
Route::get('fabric_search/{keyword}', [SortingController::class, 'search']);
Route::get('fabric_price_low_to_high', [SortingController::class, 'lowToHigh']);
Route::get('fabric_price_high_to_low', [SortingController::class, 'highToLow']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('saved_item')->group(function () {
        Route::post('add', [SavedItemController::class, 'add']);
        Route::get('', [SavedItemController::class, 'getSavedItems']);
        Route::post('delete/{item_uuid}', [SavedItemController::class, 'removeFromSaveItem']);
    });
    Route::get('profile', [ShopController::class, 'profile']);
    Route::post('update_profile', [ShopController::class, 'updateProfile']);
    Route::post('change_password', [ShopController::class, 'changePassword']);
    Route::get('shop_look/{productIds}', [ShopController::class, 'shopLook']);

    Route::post('custom_addToCart', [ShopController::class, 'custom_addToCart']);
    Route::post('custom_removeFromCart/{product_id}', [ShopController::class, 'custom_removeFromCart']);

    Route::post('cart', [ShopController::class, 'myCart']);
    Route::post('add_size', [ShopController::class, 'addSize']);
    Route::get('view/cart', [ShopController::class, 'viewCart']);
    Route::post('remove_item/{product_id}', [ShopController::class, 'removeItemFromCart']);
    Route::get('sizes/{product_uuid}', [ShopController::class, 'getSizes']);
    Route::post('select_size', [ShopController::class, 'selectSizes']);
    Route::post('checkout', [ShopController::class, 'checkout']);
    Route::post('logout', [AuthController::class, 'logout']);
});
