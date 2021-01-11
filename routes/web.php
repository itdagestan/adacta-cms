<?php

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
    return view('welcome');
})->name('home');

//Auth::routes();

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])
        ->name('home.index')
        ->middleware('auth');

    Route::resource('product-category','App\Http\Controllers\Admin\ProductCategoryController')
        ->middleware('auth');

    Route::get(
        '/product/create/{type}',
        [\App\Http\Controllers\Admin\ProductController::class, 'create']
    )->name('product.create')->middleware('auth');

    Route::post(
        '/product/create/single-product',
        [\App\Http\Controllers\Admin\ProductController::class, 'storeSingleProduct']
    )->name('product.storeSingleProduct')->middleware('auth');
    Route::put(
        '/product/update/single-product/{id}',
        [\App\Http\Controllers\Admin\ProductController::class, 'updateSingleProduct']
    )->name('product.updateSingleProduct')->middleware('auth');

    Route::post(
        '/product/create/product-with-modifications-and-units',
        [\App\Http\Controllers\Admin\ProductController::class, 'storeProductWithModificationsAndUnits']
    )->name('product.storeProductWithModificationsAndUnits')->middleware('auth');
    Route::put(
        '/product/update/product-with-modifications-and-units/{id}',
        [\App\Http\Controllers\Admin\ProductController::class, 'updateProductWithModificationsAndUnits']
    )->name('product.updateProductWithModificationsAndUnits')->middleware('auth');

    Route::post(
        '/product/create/product-redirect-link',
        [\App\Http\Controllers\Admin\ProductController::class, 'storeProductRedirectLink']
    )->name('product.storeProductRedirectLink')->middleware('auth');
    Route::put(
        '/product/update/product-redirect-link/{id}',
        [\App\Http\Controllers\Admin\ProductController::class, 'updateProductRedirectLink']
    )->name('product.updateProductRedirectLink')->middleware('auth');

    Route::resource('product','App\Http\Controllers\Admin\ProductController')
        ->middleware('auth')->except(['create', 'store', 'update']);

    Route::resource('page','App\Http\Controllers\Admin\PageController')
        ->middleware('auth');

});
