<?php

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
