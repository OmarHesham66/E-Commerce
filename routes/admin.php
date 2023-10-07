<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;

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

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

    Route::get('dashboard', DashboardController::class)->name('hello-admin');

    Route::get('/option/create/{product}', [OptionController::class, 'create'])->name('option.create.1');
    Route::get('/option/{option}/edit/{product}', [OptionController::class, 'edit'])->name('option.edit.1');
    Route::get('/order/{order}/show_addresses', [OrderController::class, 'show_addresses'])->name('order.address.show');
    Route::get('/order/{order}/show_items', [OrderController::class, 'show_items'])->name('order.items.show');
    Route::resources([
        '/category' => CategoryController::class,
        '/product' => ProductController::class,
        '/option' => OptionController::class,
        '/order' => OrderController::class,
        '/invoice' => InvoiceController::class,
        '/permission' => PermissionController::class,
    ]);
    Route::controller(AddressController::class)->group(function () {
        Route::get('address/{order}/{address}/edit', 'edit')->name('address.edit');
        Route::put('address/{address}/edit', 'update')->name('address.update');
        Route::delete('address/{address}/delete', 'destroy')->name('address.destroy');
    });
});
