<?php

use App\Http\Controllers\Web\AttributeController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CustomProducts\AttributeController as CustomProductsAttributeController;
use App\Http\Controllers\Web\CustomProducts\OptionController as CustomProductsOptionController;
use App\Http\Controllers\Web\CustomProducts\ProductController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\FabricController;
use App\Http\Controllers\Web\LookBuilderModelController;
use App\Http\Controllers\Web\LookBuilderProductController;
use App\Http\Controllers\Web\OptionController;
use App\Http\Controllers\Web\SuitController;
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
Route::post('logout', [DashboardController::class, 'logout'])->name('logout');


Route::middleware('role:admin', 'auth')->group(function () {
    Route::get('my_profile', [UserController::class, 'myProfile'])->name('profile');
    Route::post('create_user', [UserController::class, 'store'])->name('user.create');
    Route::delete('user/{user_uuid}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/', [DashboardController::class, 'landing'])->name('dashboard');

    Route::get('wedding_planner', function () {
        return view('admin.pages.wedding_planner');
    })->name('wedding_planner');


    Route::get('/orders', [DashboardController::class, 'orders'])->name('orders');
    Route::post('order/mark_delivered/{order_uuid}', [DashboardController::class, 'markAsDelivered'])->name('markAsDelivered');
    Route::get('order_details/{order_uuid}', [DashboardController::class, 'orderDetails'])->name('order_details');
    Route::get('/customers', [DashboardController::class, 'customers'])->name('customers');

    Route::prefix('look_builder_products')->group(function () {
        Route::post('add', [LookBuilderProductController::class, 'store'])->name('lookBuilder.product.store');
        Route::get('/{product_uuid}', [LookBuilderProductController::class, 'edit'])->name('lookBuilder.product.edit');
        Route::post('/{product_uuid}', [LookBuilderProductController::class, 'update'])->name('lookBuilder.product.update');
        Route::get('by_category/{uuid}', [LookBuilderProductController::class, 'byCategory'])->name('productByCategory');
    });

    Route::prefix('suits')->group(function () {
        Route::post('add', [SuitController::class, 'store'])->name('suit.add');
        Route::get('', [SuitController::class, 'list'])->name('suit.list');
        Route::get('all', [SuitController::class, 'all'])->name('suit.all');
        Route::delete('/{suit_uuid}', [SuitController::class, 'delete'])->name('suit.delete');
        Route::get('/{suit_uuid}', [SuitController::class, 'edit'])->name('suit.edit');
        Route::post('/{suit_uuid}', [SuitController::class, 'update'])->name('suit.update');
    });

    Route::prefix('custom_products')->group(function () {
        Route::post('add', [ProductController::class, 'store'])->name('custom.product.store');
        Route::delete('delete/{product_uuid}', [ProductController::class, 'delete'])->name('custom.product.delete');
        Route::get('/{product_uuid}', [ProductController::class, 'edit'])->name('custom.product.edit');
        Route::post('/{product_uuid}', [ProductController::class, 'update'])->name('custom.product.update');
        Route::get('by_category/{uuid}', [ProductController::class, 'byCategory'])->name('customProductByCategory');
    });

    Route::prefix('fabrics')->group(function () {
        Route::get('all', [FabricController::class, 'all'])->name('fabrics');
        Route::post('add', [FabricController::class, 'store'])->name('fabric.store');
        Route::delete('/{product_uuid}', [FabricController::class, 'delete'])->name('fabric.delete');
        Route::get('/{product_uuid}', [FabricController::class, 'edit'])->name('fabric.edit');
        Route::post('/{product_uuid}', [FabricController::class, 'update'])->name('fabric.update');
    });

    Route::prefix('categories')->group(function () {
        Route::get('all', [CategoryController::class, 'all'])->name('categories');
        Route::post('add', [CategoryController::class, 'store'])->name('category.store');
        Route::delete('/{product_uuid}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/{product_uuid}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/{product_uuid}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('sizes/{category_id}', [CategoryController::class, 'sizesOfCategory'])->name('category.sizes');
    });

    Route::get('all_products', [LookBuilderProductController::class, 'allProducts'])->name('allProducts');
    Route::get('custom_products', [ProductController::class, 'allProducts'])->name('customProducts');
    Route::get('products_by_fabric/{fabric_uuid}', [LookBuilderProductController::class, 'productsByFabric'])->name('productsByFabric');
    Route::delete('all_products/delete/{product_uuid}', [LookBuilderProductController::class, 'delete'])->name('product.delete');

    Route::prefix('attributes')->group(function () {
        Route::post('add', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('/{attribute_uuid}', [AttributeController::class, 'edit'])->name('attibute.edit');
        Route::post('/{attribute_uuid}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::delete('/{attribute_uuid}', [AttributeController::class, 'delete'])->name('attribute.delete');
    });
    Route::get('sizes_of_custom_products/{product_id}', [CustomProductsAttributeController::class, 'customSizeList'])->name('sizesOfCustomProduct');
    Route::post('add_size_of_custom_product/{product_id}', [CustomProductsAttributeController::class, 'addSizeInCustomProduct'])->name('add.size.custom');


    Route::prefix('custom_arrtibutes')->group(function () {
        Route::get('/by/{product_uuid}', [CustomProductsAttributeController::class, 'attributesByProduct'])->name('customAttributesByProduct');
        Route::post('add', [CustomProductsAttributeController::class, 'store'])->name('attribute.store');
        Route::get('/{attribute_uuid}', [CustomProductsAttributeController::class, 'edit'])->name('attibute.edit');
        Route::post('/{attribute_uuid}', [CustomProductsAttributeController::class, 'update'])->name('attribute.update');
        Route::delete('/{attribute_uuid}', [CustomProductsAttributeController::class, 'delete'])->name('attribute.delete');
    });
    Route::prefix('options')->group(function () {
        Route::post('add/{attribute_uuid}', [OptionController::class, 'store'])->name('option.store');
        Route::get('/{attribute_uuid}', [OptionController::class, 'optionsByAttribute'])->name('option.by.attr');
        Route::get('edit/{option_uuid}', [OptionController::class, 'optionById'])->name('option.by.id');
        Route::post('update/{option_uuid}', [OptionController::class, 'update'])->name('option.update');
        Route::delete('delete/{option_uuid}', [OptionController::class, 'delete'])->name('option.delete');
    });
    Route::prefix('custom_options')->group(function () {
        Route::post('add/{attribute_uuid}', [CustomProductsOptionController::class, 'store'])->name('custom.option.store');
        Route::get('/{attribute_uuid}', [CustomProductsOptionController::class, 'optionsByAttribute'])->name('custom.option.by.attr');
        Route::get('edit/{option_uuid}', [CustomProductsOptionController::class, 'optionById'])->name('custom.option.by.id');
        Route::post('update/{option_uuid}', [CustomProductsOptionController::class, 'update'])->name('custom.option.update');
        Route::delete('delete/{option_uuid}', [CustomProductsOptionController::class, 'delete'])->name('custom.option.delete');
        Route::get('images/{option_uuid}', [CustomProductsOptionController::class, 'custom_option_images'])->name('custom.option.images');
    });
    Route::post('image/add', [CustomProductsOptionController::class, 'addCustomOptionImage'])->name('add.custom.option.image');


    Route::prefix('look_builder_models')->group(function () {
        Route::get('', [LookBuilderModelController::class, 'list'])->name('look_builder_models.list');
        Route::post('add', [LookBuilderModelController::class, 'store'])->name('look_builder_models.store');
        Route::delete('delete/{model_uuid}', [LookBuilderModelController::class, 'delete'])->name('look_builder_models.delete');
        Route::get('/{model_uuid}', [LookBuilderModelController::class, 'edit'])->name('look_builder_models.edit');
        Route::post('/{model_uuid}', [LookBuilderModelController::class, 'update'])->name('look_builder_models.update');
    });

    Route::get('editProfile', [UserController::class, 'edit'])->name('editProfile');
    Route::post('update_profile', [UserController::class, 'update'])->name('update.profile');
    Route::post('update_password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('product_attribute/{product_uuid}', [AttributeController::class, 'attributesByProduct'])->name('attributesByProduct');
});
