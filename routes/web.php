<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\UserCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\CheckOut\CheckoutController;

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

define('PAGINATE', 12);
Route::get('/', [HomeController::class, 'get_home_site'])->name('home-site');

Route::group(['middleware' => 'guest'], function () {
    /////////////////////////////////////////HOME/////////////////////////////////////////////
    // Route::get('/', [HomeController::class, 'get_home_site'])->name('welcome');
    /////////////////////////////////////////LOGIN & REGISTER /////////////////////////////////////////////
    Route::get('/login', [AuthController::class, 'get_login'])->name('get_login');
    Route::post('/login', [AuthController::class, 'post_login'])->name('post_login');
    Route::get('/register', [AuthController::class, 'get_register'])->name('get_register');
    Route::post('/register', [AuthController::class, 'post_register'])->name('post_register');
});
Route::group(['namespace' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('/logout', [AuthController::class, 'get_logout'])->name('get_logout');
});
/////////////////////////////////////////SHOP/////////////////////////////////////////////
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop/{data?}', 'get_shop')->name('get_shop');
});
/////////////////////////////////////////PRODUCT-DETIALS///////////////////////////////////////////////////////////
Route::get('/product-details/{id}', [ProductController::class, 'get_details_product'])->name('get_details_product');
/////////////////////////////////////////CART///////////////////////////////////////////////////////////
Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/show', 'show')->name('show.cart');
    Route::post('/discount', 'check_coupone')->name('check.coupone');
    // Route::delete('/cart', 'delete')->name('delete.cart');
});
Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
    Route::get('/show', 'show')->name('checkout.show');
});
Route::get('/pop', function () {
    $cart = UserCart::first();
    // $cartItem = $cart->Products;
    // return $cart->Products[0]->pivot;
    // $options = $cart->CartItems()->with('Options')->get();
    // return $cart;
    return $cart->Products[0];
});
