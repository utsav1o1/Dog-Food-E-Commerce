<?php

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

Route::get('/',[ProjectController::class,'index'])->name('home');

Route::get('/product', function(){
    return redirect('/');
} );
Route::get('/products',[ProjectController::class,'products'] )->name('products');
Route::get('/product/{id}',[ProjectController::class,'single_product'] )->name('single_product');

