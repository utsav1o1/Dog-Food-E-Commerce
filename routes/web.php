<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', [ProjectController::class, 'index'])->name('home');

Route::get('/product', function () {
    return redirect('/');
});
Route::get('/products', [ProjectController::class, 'products'])->name('products');
Route::get('/product/{id}', [ProjectController::class, 'single_product'])->name('single_product');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart', function () {
    return redirect('/');
});

Route::post('/remove', [CartController::class, 'remove'])->name('remove');
Route::get('/remove', function () {
    return redirect('/cart');
});

Route::post('/edit_product_quantity', [CartController::class, 'edit_quantity'])->name('edit_quantity');
Route::get('/edit_product_quantity', function () {
    return redirect('/cart');
});

Route::get('/about', function(){
    return view('about');
})->name('about');


Route::get('/checkout',[CartController::class, 'checkout'])->name('checkout');
