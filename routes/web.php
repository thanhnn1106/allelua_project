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
    Route::get('dashboard', 'Admin\DashBoardController@index')->name('admin_dashboard');
    Route::get('user', 'Admin\UserManageController@index')->name('admin_user');
    Route::get('user/change_status/{id}', 'Admin\UserManageController@changeStatus')->name('admin_user_status');
    Route::get('user/delete/{id}', 'Admin\UserManageController@delete')->name('admin_user_delete');
    Route::get('profile', 'Admin\DashBoardController@index')->name('admin_profile');

    Route::get('setting', 'Admin\GeneralController@index')->name('admin_setting_general');
});
