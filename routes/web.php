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
    return view('customers.home');
})->name('home');

Route::get('/home', function () {
    return view('customers.home');
})->name('home');

Route::get('/product', function () {
    return view('customers.products.index');
})->name('product');

Route::get('/discover', function () {
    return view('customers.products.index');
})->name('discover');

Route::get('/help', function () {
    return view('customers.help');
})->name('help');

Route::get('/profile', function () {
    return view('customers.profiles.profile');
})->name('profile');

Route::get('/cart', function () {
    return view('customers.carts.cart');
})->name('cart');
