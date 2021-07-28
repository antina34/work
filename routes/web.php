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

/* Google Login */
Route::get('/google-login', 'Auth\LoginController@redirectToProvider')->name('google.login');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('google.callback');

/* Landing */
Route::get('/', 'LandingController@index')->name('landing');
Route::get('/privacy-policy', 'LandingController@privacyPolicy')->name('landing.privacy-policy');

/* Login */
Route::get('/admin', 'Admin\DashboardController@index')->name('admin.index');
Route::post('/admin', 'Auth\LoginController@adminLogin')->name('admin.login');

Route::middleware(['auth.admin'])->prefix('admin')->namespace('Admin')->group(static function () {
    /* API */
    Route::get('/api/btc', 'DashboardController@getBtc')->name('admin.btc.api');

    /* Dashboard */
    Route::get('/dashboard', 'DashboardController@dashboard')->name('admin.dashboard');

    /* Invoices */
    Route::resource('invoices', 'InvoiceController')->names([
        'index' => 'admin.invoices.index',
        'show' => 'admin.invoices.show'
    ]);

    /* Orders */
    Route::get('/orders', 'OrderController@index')->name('admin.orders.index');
    Route::get('/order/{id}', 'OrderController@show')->name('admin.orders.show');

    /* Predictions */
    Route::get('/prediction', 'DashboardController@prediction')->name('admin.prediction');

    /* Products */
    Route::resource('products', 'ProductController')->names([
        'index' => 'admin.products.index',
        'store' => 'admin.products.store',
        'create' => 'admin.products.create',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
        'edit' => 'admin.products.edit'
    ]);

    /* Subscriptions */
    Route::resource('subscription-plans', 'SubscriptionPlanController')->names([
        'index' => 'admin.subscription-plans.index',
        'store' => 'admin.subscription-plans.store',
        'create' => 'admin.subscription-plans.create',
        'update' => 'admin.subscription-plans.update',
        'destroy' => 'admin.subscription-plans.destroy',
        'edit' => 'admin.subscription-plans.edit'
    ]);
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(static function () {
    /* API */
    Route::get('/api/btc', 'DashboardController@getBtc')->name('btc.api');

    /* Cart */
    Route::get('/cart/{id}', 'CartController@checkout')->name('checkout');

    /* Dashboard */
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    /* Invoices */
    Route::get('/my-invoices', 'InvoiceController@index')->name('invoices.index');
    Route::get('/invoices/{id}}', 'InvoiceController@show')->name('invoices.show');

    /* Orders */
    Route::get('/my-orders', 'OrderController@index')->name('orders.index');
    Route::get('/order/{id}', 'OrderController@show')->name('orders.show');

    /* Settings */
    Route::get('/settings', 'UserController@view')->name('settings');

    /* User */
    Route::post('/user/{id}', 'UserController@update')->name('user.update');
});
