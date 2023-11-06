<?php


use App\Models\UserCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\MyAccountController;

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
/////////////////////////////////////////HOME/////////////////////////////////////////////
Route::get('/', [HomeController::class, 'get_home_site'])->name('home-site');
/////////////////////////////////////////LOGIN & REGISTER /////////////////////////////////////////////
Route::group(['namespace' => 'User', 'middleware' => 'guest:admin,web'], function () {
    Route::get('/login', [AuthController::class, 'get_login'])->name('get_login');
    Route::post('/login', [AuthController::class, 'post_login'])->name('post_login');
    Route::get('/register', [AuthController::class, 'get_register'])->name('get_register');
    Route::post('/register', [AuthController::class, 'post_register'])->name('post_register');
});
Route::group(['namespace' => 'User', 'middleware' => 'auth:web,admin'], function () {
    Route::get('/logout', [AuthController::class, 'get_logout'])->name('get_logout');
});
/////////////////////////////////////////SHOP/////////////////////////////////////////////
Route::controller(ShopController::class)->group(function () {
    Route::any('/shop/{data?}', 'get_shop')->name('get_shop');
});
/////////////////////////////////////////PRODUCT-DETIALS///////////////////////////////////////////////////////////
Route::get('/product-details/{id}', [ProductController::class, 'get_details_product'])->name('get_details_product');
/////////////////////////////////////////CART///////////////////////////////////////////////////////////
Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/show', 'show')->name('show.cart');
    // Route::delete('/cart', 'delete')->name('delete.cart');
});
/////////////////////////////////////////CHECKOUT///////////////////////////////////////////////////////////
Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
    Route::get('/show', 'show')->name('checkout.show');
    Route::post('/create', 'create')->name('create.checkout')->middleware('auth:web');
    Route::post('/discount', 'check_coupone')->name('check.coupone')->middleware('auth:web');
});
/////////////////////////////////////////PAYMENT///////////////////////////////////////////////////////////
Route::controller(PaymentController::class)->prefix('payment')->group(function () {
    // Route::post('/{order}/show', 'show')->name('payment.show')->middleware('auth:web');
    Route::get('/callback', 'callback')->name('payment.callback');
    Route::get('/failed', 'failed')->name('payment.failed');
});
/////////////////////////////////////////MYACCOUNT///////////////////////////////////////////////////////////
Route::controller(MyAccountController::class)->prefix('account')->middleware('auth:web')->group(function () {
    Route::get('/data', 'index')->name('account.index');
    Route::post('/edit/account', 'edit')->name('account.edit');
});
Route::get('/pop', function () {
    return bcrypt('123456789');
});
