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
Route::get('lang', 'LangController@index')->name('home_lang');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('load-categories', 'Ajax\ProductController@loadCategories')->name('ajax_product_load_cate');
    Route::get('load-style', 'Ajax\ProductController@loadStyle')->name('ajax_product_load_style');
    Route::get('load-seller', 'Ajax\UserController@loadSeller')->name('ajax_load_seller');
});

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

    // Category
    Route::get('category/main', 'Admin\CategoryController@index')->name('admin_category_main');
    Route::match(['get', 'post'], 'category/edit/{id}/{parent_id}', 'Admin\CategoryController@edit')->name('admin_category_edit');
    Route::post('category/sort', 'Admin\CategoryController@sort')->name('admin_category_sort');
    Route::get('category/sub/{id}', 'Admin\CategoryController@sub')->name('admin_category_sub');

    // Product
    Route::get('product', 'Admin\ProductController@index')->name('admin_product_index');
    Route::get('product/add', 'Admin\ProductController@add')->name('admin_product_add');
    Route::get('product/edit/{id}', 'Admin\ProductController@edit')->name('admin_product_edit');
    Route::get('product/delete/{id}', 'Admin\ProductController@delete')->name('admin_product_delete');
    Route::post('product/save', 'Admin\ProductController@save')->name('ajax_admin_product_save');
});

Route::get('seller_dashboard', 'Seller\DashBoardController@index')->name('seller_dashboard');
Route::match(['get', 'post'], 'seller/register', 'Auth\RegisterController@register')->name('seller_register');
Auth::routes();
