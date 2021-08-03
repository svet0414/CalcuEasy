<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
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
    return view('products');
});

Route::get('fetch-products',[ProductController::class,'fetchProducts']);
Route::get('edit-products/{id}',[ProductController::class,'editProducts']);
Route::put('update-products/{id}',[ProductController::class,'updateProducts']);
Route::delete('delete-products/{id}',[ProductController::class,'deleteProducts']);
Route::resource('products', ProductController::class);


