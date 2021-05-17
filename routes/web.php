<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SalesDeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master-lists', function() {
    return view('master_lists');
})->name('master-lists');

Route::get('/sales-deliveries', [SalesDeliveryController::class, 'index'])->name('sales-delivery-index');
Route::get('/sales-deliveries/create', [SalesDeliveryController::class, 'create'])->name('sales_delivery_create');
Route::get('/sales-deliveries/{salesDelivery}/edit', [SalesDeliveryController::class, 'edit'])->name('sales_delivery_edit');
Route::get('/sales-deliveries/{salesDelivery}', [SalesDeliveryController::class, 'show']);

Route::get('/sales-orders', [SalesOrderController::class, 'index'])->name('sales-order-index');
Route::get('/sales-orders/create', [SalesOrderController::class, 'create']);
Route::get('/sales-orders/{salesOrder}/edit', [SalesOrderController::class, 'edit']);
Route::get('/sales-orders/{salesOrder}', [SalesOrderController::class, 'show']);

Route::get('/customers', [CustomerController::class, 'index'])->name('customer-index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer_create');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customer_edit');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customer_show');

Route::get('/products', [ProductController::class, 'index'])->name('product-index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product_create');
Route::get('/products/{product}/movements', [ProductController::class, 'movements'])->name('product_movements');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product_edit');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product_show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
