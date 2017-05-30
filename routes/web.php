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

Route::match(['get', 'post'], 'administrator/login', 'Auth\LoginController@loginAdmin')->name('admin_login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.admin']], function () {
    Route::get('dashboard', 'Admin\HomeController@index')->name('admin_dashboard');
});
