<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->namespace('Admin')->middleware('isadmin')->name('admin.')->group(function () {
        Route::get('/','DashboardController')->name('dashboard');
        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');
        Route::resource('users', UserController::class)->except('show');

        // products
        Route::resource('products', ProductController::class)->except('show');

        // product prices
        Route::resource('product-prices', ProductPriceController::class)->except('show');

        // setting
        Route::get('setting', 'SettingController@index')->name('setting.index');
        Route::post('setting', 'SettingController@store')->name('setting.store');

        // payments
        Route::resource('payments', PaymentController::class)->except('show');

        // transaction
        Route::get('transactions', 'TransactionController@index')->name('transactions.index');
        Route::delete('transactions/{id}', 'TransactionController@destroy')->name('transactions.destroy');
        Route::post('transactions/{id}/change', 'TransactionController@change')->name('transactions.change');

    });
    Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
    Route::post('/transaction', 'TransactionController@store')->name('transaction.store');
    Route::get('transaction/success/{uuid}/detail', 'TransactionController@success')->name('transaction.success');
    Route::post('transaction/confirm/{id}', 'TransactionController@confirm')->name('transaction.confirm');
    
});

Route::get('/', 'HomeController')->name('home');
Route::get('/about', 'AboutController')->name('about');

Route::get('/product/{slug}', 'ProductController@show')->name('product.show');
