<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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
Route::get('/products',[ProductController::class,'indexAdmins'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create']) ->name('products.create');
Route::post('/products',[ProductController::class,'store']) -> name('products.store');
Route::get('/products/{product}/edit',[ProductController::class,'edit']) -> name('products.edit');
Route::put('/products/{product}/update',[ProductController::class,'update']) -> name('products.update');
Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
