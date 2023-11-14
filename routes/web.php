<?php

use App\Http\Controllers\Web\LookBuilderProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.pages.index');
})->name('dashboard');
Route::get('/orders', function () {
    return view('admin.pages.orders.all');
})->name('orders');
Route::get('/customers', function () {
    return view('admin.pages.customers.all');
})->name('customers');
Route::get('all_products', function () {
    return view('admin.pages.products.all');
})->name('allProducts');
Route::get('custom_product_attribute', function () {
    return view('admin.pages.products.custom_attribute');
})->name('custom_product_attribute');
Route::get('wedding_planner', function () {
    return view('admin.pages.wedding_planner');
})->name('wedding_planner');
Route::get('shirts', function () {
    return view('admin.pages.look_builder.shirts');
})->name('shirts');

Route::prefix('look_builder_products')->group(function () {
    Route::post('add', [LookBuilderProductController::class, 'store'])->name('lookBuilder.product.store');
});
