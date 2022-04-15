<?php

use App\Http\Controllers\Admin\CartAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store'])->name('post-admin');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);


        // Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create'])->name('add-category');
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index'])->name('list-categories');
            Route::get('edit/{menu}', [MenuController::class, 'show'])->name('edit-category');
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductAdminController::class, 'create'])->name('add-product');
            Route::post('add', [ProductAdminController::class, 'store']);
            Route::get('list', [ProductAdminController::class, 'index'])->name('list-product');
            Route::get('edit/{product}', [ProductAdminController::class, 'show'])->name('edit-product');
            Route::post('edit/{product}', [ProductAdminController::class, 'update']);
            Route::DELETE('destroy', [ProductAdminController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store'])->name('upload_image');

        #Product
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create'])->name('add-slider');
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index'])->name('list-slider');
            Route::get('edit/{slider}', [SliderController::class, 'show'])->name('edit-slider');
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #Cart
        Route::get('customers', [CartAdminController::class, 'index'])->name('customers');
        Route::get('customers/view/{customer}', [CartAdminController::class, 'show']);
    });
});

Route::get('/', [MainController::class, 'index']);
Route::post('/services/load-product', [MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}', [CateController::class, 'index']);
Route::get('san-pham/{id}-{slug}', [ProductController::class, 'index']);

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);
