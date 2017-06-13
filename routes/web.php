<?php

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



Route::get('/cart', 'CartController@show')->name('cart');
Route::get('/cart/view', 'CartController@showCart');
Route::get('/cart/add/{id}', 'CartController@add');
Route::get('/cart/remove/{id}', 'CartController@remove');
Route::post('/cart/remove_all', 'CartController@removeAll');
Route::get('/cart/image', 'CartController@image');
Route::post('/cart/image_save', 'CartController@saveImage');
Route::get('/cart/image_get/{fileName}', 'CartController@getImage');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
     Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
     Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
     Route::get('/', 'AdminsController@index')->name('admin.dashboard');
     Route::post('/edit/{id}', 'AdminsController@editProduct')->name('admin.edit');
     Route::get('/editView/{id}', 'AdminsController@editView')->name('admin.editView');
     Route::post('/addProduct', 'AdminsController@addProduct')->name('admin.add');
     Route::get('/addForm', 'AdminsController@renderAddForm')->name('admin.addForm');
     Route::post('/delete/{id}', 'AdminsController@deleteProduct')->name('admin.delete');
     Route::get('/cart/image_get/{fileName}', 'AdminsController@getImage');
});



Route::get('/checkout', [
    'uses' => 'cartController@getCheckout',
    'as' => 'checkout',
    // 'middleware' => 'auth'
]);

Route::post('/checkout', [
    'uses' => 'cartController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);

        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});
