<?php

use App\Http\Controllers\Web\AttributeController;
use App\Http\Controllers\Web\FabricController;
use App\Http\Controllers\Web\LookBuilderModelController;
use App\Http\Controllers\Web\LookBuilderProductController;
use App\Http\Controllers\Web\OptionController;
use App\Http\Controllers\Web\UserController;
use App\Models\LookBuilderModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('login', function () {
    return view('login');
})->name('login');
Route::get('register', function () {
    return view('register');
});
Route::get('my_profile', [UserController::class, 'myProfile'])->name('profile');
Route::post('create_user', [UserController::class, 'store'])->name('user.create');
Route::delete('user/{user_uuid}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/', function () {
    return view('admin.pages.index');
})->name('dashboard')->middleware('auth');
Route::get('/orders', function () {
    return view('admin.pages.orders.all');
})->name('orders');
Route::get('/customers', function () {
    return view('admin.pages.customers.all');
})->name('customers');


Route::get('wedding_planner', function () {
    return view('admin.pages.wedding_planner');
})->name('wedding_planner');


Route::prefix('look_builder_products')->group(function () {
    Route::post('add', [LookBuilderProductController::class, 'store'])->name('lookBuilder.product.store');
    Route::get('by_category/{uuid}', [LookBuilderProductController::class, 'byCategory'])->name('productByCategory');
});

Route::prefix('fabrics')->group(function () {
    Route::get('all', [FabricController::class, 'all'])->name('fabrics');
    Route::post('add', [FabricController::class, 'store'])->name('fabric.store');
});

Route::get('all_products', [LookBuilderProductController::class, 'allProducts'])->name('allProducts');
Route::get('products_by_fabric/{fabric_uuid}', [LookBuilderProductController::class, 'productsByFabric'])->name('productsByFabric');
Route::delete('all_products/delete/{product_uuid}', [LookBuilderProductController::class, 'delete'])->name('product.delete');

Route::prefix('attributes')->group(function () {
    Route::post('add', [AttributeController::class, 'store'])->name('attribute.store');
});
Route::prefix('options')->group(function () {
    Route::post('add/{attribute_uuid}', [OptionController::class, 'store'])->name('option.store');
    Route::get('/{attribute_uuid}', [OptionController::class, 'optionsByAttribute'])->name('option.by.attr');
    Route::get('edit/{option_uuid}', [OptionController::class, 'optionById'])->name('option.by.id');
    Route::post('update/{option_uuid}', [OptionController::class, 'update'])->name('option.update');
    Route::delete('delete/{option_uuid}', [OptionController::class, 'delete'])->name('option.delete');
});

Route::prefix('look_builder_models')->group(function () {
    Route::get('', [LookBuilderModelController::class, 'list'])->name('look_builder_models.list');
    Route::post('add', [LookBuilderModelController::class, 'store'])->name('look_builder_models.store');
});
Route::get('editProfile', [UserController::class, 'edit'])->name('editProfile');
Route::post('update_profile', [UserController::class, 'update'])->name('update.profile');
Route::post('update_password', [UserController::class, 'updatePassword'])->name('update.password');
Route::get('product_attribute/{product_uuid}', [AttributeController::class, 'attributesByProduct'])->name('attributesByProduct');
