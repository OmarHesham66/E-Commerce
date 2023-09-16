<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\UserCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Product\ProductController;

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
Route::group(['middleware' => 'guest'], function () {
    /////////////////////////////////////////HOME/////////////////////////////////////////////
    Route::get('/', [HomeController::class, 'get_home_site'])->name('welcome');
    /////////////////////////////////////////LOGIN & REGISTER /////////////////////////////////////////////
    Route::get('/login', [AuthController::class, 'get_login'])->name('get_login');
    Route::post('/login', [AuthController::class, 'post_login'])->name('post_login');
    Route::get('/register', [AuthController::class, 'get_register'])->name('get_register');
    Route::post('/register', [AuthController::class, 'post_register'])->name('post_register');
});
Route::group(['namespace' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('/home', [HomeController::class, 'get_home_site'])->name('home-site');
    Route::get('/logout', [AuthController::class, 'get_logout'])->name('get_logout');
});
/////////////////////////////////////////SHOP/////////////////////////////////////////////
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'get_shop')->name('get_shop');
    Route::get('/fashion', 'get_fashion')->name('fashion');
    Route::get('/shop-categories/{category_id}', 'get_shop_by_category')->name('get_shop_by_category');
    Route::get('/shop-deals', 'get_shop_by_discount')->name('get_shop_by_discount');
    Route::get('/shop-summer', 'get_shop_by_summer')->name('get_shop_by_summer');
});

/////////////////////////////////////////PRODUCT-DETIALS///////////////////////////////////////////////////////////
Route::get('/product-details/{id}', [ProductController::class, 'get_details_product'])->name('get_details_product');
Route::get('lol/{id}', function ($id) {
    $options_ids = [];
    $qtys = [];
    for ($i = count([2, 2, 2, 2]) - 1; $i > 0; $i--) {
        if ($id <= [2, 2, 2, 2][$i]) {
            array_push($qtys, (int)$id);
            array_push($options_ids, [2, 8, 20, 50][$i]);
            return [$options_ids, $qtys];
        }
        $id = $id - [2, 2, 2, 2][$i];
        array_push($qtys, [2, 2, 2, 2][$i]);
        array_push($options_ids, [2, 8, 20, 50][$i]);
    }
    return [$options_ids, $qtys];
});
