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

// Static page
Route::get('/{slug}', 'Front\StaticPageController@index')->name('static_page');
Route::get('/', 'Front\HomeController@index')->name('home');

Route::match(['get', 'post'], 'register', 'Auth\RegisterController@register')->name('seller_register');
Route::match(['get', 'post'], 'account/login', 'Auth\LoginController@loginSeller')->name('seller_login');
Route::match(['get', 'post'], 'account/ajax-login', 'Auth\LoginController@loginAjaxSeller')->name('seller_ajax_login');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password_request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password_email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password_reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset_password');

Route::match(['get', 'post'], 'administrator/login', 'Auth\LoginController@loginAdmin')->name('admin_login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('{lt}', 'Front\LangController@index')->name('home_lang');

// Product
Route::get('search', 'Front\SearchController@index')->name('search_page');
Route::get('products/{slug}', 'Front\ProductController@loadCate')->name('product_load_cate');
Route::get('products/detail/{slug}', 'Front\ProductController@detail')->name('product_detail');
Route::get('products/{slug}/{id}', 'Front\ProductController@loadSub')->name('product_load_sub_cate');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('load-categories', 'Ajax\ProductController@loadCategories')->name('ajax_product_load_cate');
    Route::get('load-style', 'Ajax\ProductController@loadStyle')->name('ajax_product_load_style');
    Route::get('load-seller', 'Ajax\UserController@loadSeller')->name('ajax_load_seller');
    Route::post('product/upload-file', 'Ajax\ProductController@upload')->name('ajax_product_upload_file');
    Route::post('product/delete-file', 'Ajax\ProductController@deleteFile')->name('ajax_product_delete_file');
    Route::get('load-seller-personal', 'Ajax\UserController@loadSellerPersonal')->name('ajax_load_seller_personal');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.admin']], function () {
    Route::get('dashboard', 'Admin\DashBoardController@index')->name('admin_dashboard');

    // Users
    Route::get('user', 'Admin\UserManageController@index')->name('admin_user');
    Route::get('user/change_status/{id}', 'Admin\UserManageController@changeStatus')->name('admin_user_status');
    Route::get('user/delete/{id}', 'Admin\UserManageController@delete')->name('admin_user_delete');
    Route::match(['get', 'post'], 'user/add', 'Admin\UserManageController@add')->name('admin_user_add');
    Route::match(['get', 'post'], 'user/edit/{id}', 'Admin\UserManageController@edit')->name('admin_user_edit');
    Route::get('user/personal_info/edit', 'Admin\UserPersonalController@editPersonalInfo')->name('admin_user_personal_edit');
    Route::post('user/personal_info/update', 'Admin\UserPersonalController@editPersonalInfo')->name('admin_user_personal_update');
    Route::get('user/personal_info', 'Admin\UserPersonalController@index')->name('admin_user_personal_list');
    Route::match(['get', 'post'], 'user/personal_info/add', 'Admin\UserPersonalController@add')->name('admin_user_personal_add');

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

    // Static Page
    Route::get('static_page', 'Admin\StaticPageController@index')->name('admin_manage_static_page');
    Route::match(['get', 'post'], 'static_page/edit', 'Admin\StaticPageController@edit')->name('admin_edit_static_page');
});

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'auth.seller']], function () {
    Route::get('dashboard', 'Seller\DashBoardController@index')->name('seller_dashboard');

    Route::match(['get', 'post'], 'change_password', 'Seller\ManageController@changePasswordSeller')->name('seller_change_password');
    Route::match(['get', 'post'], 'account_management', 'Seller\ManageController@accountManagement')->name('seller_account_management');
    Route::match(['get', 'post'], 'new_post', 'Seller\ManageController@newPost')->name('seller_new_post');
    Route::match(['get', 'post'], 'inbox', 'Seller\ManageController@inbox')->name('seller_inbox');

    // Product
    Route::get('product/list', 'Seller\ProductController@index')->name('seller_product_index');
    Route::get('product/create', 'Seller\ProductController@add')->name('seller_product_create');
    Route::get('product/edit/{id}', 'Seller\ProductController@edit')->name('seller_product_edit');
    Route::post('product/save', 'Seller\ProductController@save')->name('seller_product_save');
    Route::get('product/delete/{id}', 'Seller\ProductController@delete')->name('seller_product_delete');

    Route::post('favorite', 'Seller\FavoriteController@index')->name('seller_product_favorite');
    Route::get('favorite/lists', 'Seller\FavoriteController@lists')->name('seller_product_favorite_lists');
});
//Auth::routes();
