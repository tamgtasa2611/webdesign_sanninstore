<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\CheckLoginCustomer;
use App\Http\Controllers\OrderController;

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
    return view('customers.home');
})->name('home');

Route::get('/home', function () {
    return view('customers.home');
})->name('home');

Route::get('/product', [ProductController::class, 'index'])->name('product');

//show 1 product
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');


Route::get('/discover', function () {
    return view('customers.products.discover');
})->name('discover');

Route::get('/help', function () {
    return view('customers.help');
})->name('help');

//check login
Route::middleware(CheckLoginCustomer::class)->group(function () {
    Route::get('/profile', [CustomerController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');

    Route::get('/orders_history', [CustomerController::class, 'showOrdersHistory'])->name('ordersHistory');

    Route::get('/change_password', [CustomerController::class, 'editPassword'])->name('pwd.edit');
    Route::put('/change_password', [CustomerController::class, 'updatePassword'])->name('pwd.update');

    Route::get('/cart', [ProductController::class, 'cart'])->name('product.cart');
    Route::get('/addToCart/{id}', [ProductController::class, 'addToCart'])->name('product.addToCart');
    Route::get('/addToCartAjax/{id}', [ProductController::class, 'addToCartAjax'])->name('product.addToCartAjax');
    Route::get('/updateCartQuantity/{id}', [ProductController::class, 'updateCartQuantity'])->name('product.updateCartQuantity');
    Route::get('/deleteFromCart/{id}', [ProductController::class, 'deleteFromCart'])->name('product.deleteFromCart');
    Route::get('/deleteAllFromCart', [ProductController::class, 'deleteAllFromCart'])->name('product.deleteAllFromCart');

    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'checkoutProcess'])->name('checkoutProcess');
});

Route::get('/register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('/register', [CustomerController::class, 'registerProcess'])->name('customer.registerProcess');

Route::get('/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('customer.loginProcess');

Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/forgot_password', [CustomerController::class, 'forgotPassword'])->name('customer.forgotPassword');


//ADMIN
Route::get('/admin/customer', [CustomerController::class, 'show'])->name('admin/customer');
Route::get('/create', [CustomerController::class, 'create'])->name('customer/create');
Route::post('/create', [CustomerController::class, 'store'])->name('customer/store');
//show edit form
Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer/edit');
Route::put('/{customer}/edit', [CustomerController::class, 'update'])->name('customer/update');
Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customer/destroy');
//PRODUCTS
Route::get('/products', [ProductController::class, 'indexAdmins'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/{products}', [ProductController::class, 'destroy'])->name('products.destroy');
