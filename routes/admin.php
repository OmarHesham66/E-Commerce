<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CouponeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleUserController;
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
    Route::resources([
        '/category' => CategoryController::class,
        '/product' => ProductController::class,
        '/option' => OptionController::class,
        '/order' => OrderController::class,
        '/invoice' => InvoiceController::class,
        '/permission' => PermissionController::class,
        '/admin' => AdminsController::class,
        '/coupone' => CouponeController::class,
    ]);
    Route::controller(AddressController::class)->group(function () {
        // Route::get('address/{order}/{address}/edit', 'edit')->name('address.edit');
        // Route::put('address/{address}/edit', 'update')->name('address.update');
        Route::delete('address/{address}/delete', 'destroy')->name('address.destroy');
    });
    Route::controller(RoleUserController::class)->group(function () {
        Route::get('role/select/{id}', 'select')->name('role.select');
        Route::post('role/select', 'store')->name('role.store');
        Route::delete('role/unset', 'unset')->name('role.unset');
    });
});
