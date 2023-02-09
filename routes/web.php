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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add'); 
 
Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success'); 

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success'); 

Route::group(['middleware' => ['auth']], function(){

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [App\Http\Controllers\DashboardController::class, 'details'])->name('dashboard-transactions-details');
    Route::get('/dashboard-account', [App\Http\Controllers\DashboardController::class, 'account'])->name('dashboard-account');
    Route::post('/dashboard-account-{redirect}', [App\Http\Controllers\DashboardController::class, 'update'])->name('dashboard-account-redirect');
    Route::post('/dashboard/{id}', [App\Http\Controllers\DashboardController::class, 'updatee'])->name('dashboard-transaction-update');

});
Route::prefix('admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
        Route::get('/dashboard/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'details'])->name('admin-dashboard-transactions-detail');
        Route::post('/dashboard/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'update'])->name('admin-dashboard-transactions-update');
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('/product-gallery', App\Http\Controllers\Admin\ProductGalleryController::class);
        Route::resource('/transaction', App\Http\Controllers\Admin\TransactionController::class);
    });

Auth::routes();


