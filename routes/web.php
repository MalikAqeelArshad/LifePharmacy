<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

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
Route::get('/clear', function () {
	// Artisan::call('migrate', ["--force"=> true ]);
	Artisan::call('optimize:clear'); // clear everything e.g. cache
	Artisan::call('optimize'); // clear everything e.g. cache
	return 'Compiled views cleared! <br> Application cache cleared! <br> Route cache cleared! <br> Configuration cache cleared! <br> Compiled services and packages files removed! <br> Caches cleared successfully!';
});

Route::get('/', function () {
	$products = Product::wherePublish(true)->paginate(10);
    return view('index', compact('products'));
})->name('index');

Route::get('/product/{id}', function ($id) {
	$product = Product::findOrFail($id);
    return view('pages.product-detail', compact('product'));
})->name('product.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::view('home', 'home')->name('home')->middleware(['auth','verified']);

Route::group(['middleware' => ['auth','verified','role']], function(){
	/* resource methods */
	Route::resource('products', ProductController::class)->except(['show']);
	Route::resource('orders', OrderController::class)->except(['show']);
});
