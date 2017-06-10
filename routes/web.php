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
Route::match(['get', 'post'], 'seller/login', 'Auth\LoginController@loginSeller')->name('seller_login');
Route::match(['get', 'post'], 'seller/change_password/{id}', 'Seller\ManageController@changePasswordSeller')->name('seller_change_password');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.admin']], function () {
    Route::get('dashboard', 'Admin\DashBoardController@index')->name('admin_dashboard');

    // Users
    Route::get('user', 'Admin\UserManageController@index')->name('admin_user');
    Route::get('user/change_status/{id}', 'Admin\UserManageController@changeStatus')->name('admin_user_status');
    Route::get('user/delete/{id}', 'Admin\UserManageController@delete')->name('admin_user_delete');
    Route::match(['get', 'post'], 'user/add', 'Admin\UserManageController@add')->name('admin_user_add');
    Route::match(['get', 'post'], 'user/edit/{id}', 'Admin\UserManageController@edit')->name('admin_user_edit');

    // Profile
    Route::match(['get', 'post'], 'profile', 'Admin\UserProfileController@edit')->name('admin_profile');

    // Setting
    Route::match(['get', 'post'], 'general', 'Admin\GeneralController@index')->name('admin_setting_general');
    Route::match(['get', 'post'], 'setting', 'Admin\SettingController@index')->name('admin_setting_socical');
});

Route::get('seller_dashboard', 'Seller\DashBoardController@index')->name('seller_dashboard');
Route::match(['get', 'post'], 'seller/register', 'Auth\RegisterController@register')->name('seller_register');