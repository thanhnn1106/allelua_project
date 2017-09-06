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
Route::get('page/{slug}', 'Front\StaticPageController@index')->name('static_page');
Route::get('/', 'Front\HomeController@index')->name('home');

// User
Route::match(['get', 'post'], 'auth/login', 'Auth\LoginController@loginUser')->name('user_login');
Route::match(['get', 'post'], 'auth/register', 'Auth\RegisterController@registerUser')->name('user_register');
Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');

// Seller
Route::match(['get', 'post'], 'account/register', 'Auth\RegisterController@register')->name('seller_register');
Route::match(['get', 'post'], 'account/login', 'Auth\LoginController@loginSeller')->name('seller_login');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password_request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password_email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password_reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset_password');

Route::match(['get', 'post'], 'administrator/login', 'Auth\LoginController@loginAdmin')->name('admin_login');

Route::get('{lt}', 'Front\LangController@index')->name('home_lang');

Route::get('contact/send-request', 'Front\ContactController@index')->name('contact');
Route::post('contact/send-request', 'Front\ContactController@index')->name('contact');

// Product
Route::get('search', 'Front\SearchController@index')->name('search_page');
Route::get('products/{slug}', 'Front\ProductController@loadCate')->name('product_load_cate');
Route::get('products/detail/{slug}', 'Front\ProductController@detail')->name('product_detail');
Route::get('products/{slug}/{id}', 'Front\ProductController@loadSub')->name('product_load_sub_cate');

// Cart
Route::post('cart/add', 'Front\CartController@add')->name('cart_add');
Route::get('cart/list', 'Front\CartController@lists')->name('cart_list');
Route::get('cart/remove/{id}', 'Front\CartController@remove')->name('cart_remove');
Route::post('cart/update', 'Front\CartController@update')->name('cart_update');

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
    Route::get('user-deleted-list', 'Admin\UserManageController@deletedList')->name('admin_user_deleted_list');
    Route::get('user/change_status/{id}', 'Admin\UserManageController@changeStatus')->name('admin_user_status');
    Route::get('user/delete/{id}', 'Admin\UserManageController@delete')->name('admin_user_delete');
    Route::get('user/restore/{id}', 'Admin\UserManageController@restore')->name('admin_user_restore');
    Route::get('user/delete-force/{id}', 'Admin\UserManageController@forceDelete')->name('admin_user_force_deleted');
    Route::match(['get', 'post'], 'user/add', 'Admin\UserManageController@add')->name('admin_user_add');
    Route::match(['get', 'post'], 'user/edit/{id}', 'Admin\UserManageController@edit')->name('admin_user_edit');

    // Manage personal information
    Route::get('user/personal_info/edit', 'Admin\UserPersonalController@editPersonalInfo')->name('admin_user_personal_edit');
    Route::post('user/personal_info/update', 'Admin\UserPersonalController@editPersonalInfo')->name('admin_user_personal_update');
    Route::get('user/personal_info', 'Admin\UserPersonalController@index')->name('admin_user_personal_list');
    Route::match(['get', 'post'], 'user/personal_info/add', 'Admin\UserPersonalController@add')->name('admin_user_personal_add');
    Route::match(['get', 'post'], 'user/personal_info/approve', 'Admin\UserPersonalController@approve')->name('admin_user_personal_approved');

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
    Route::get('product/deleted', 'Admin\ProductController@listDeleted')->name('admin_product_deleted_index');
    Route::get('product/add', 'Admin\ProductController@add')->name('admin_product_add');
    Route::get('product/edit/{id}', 'Admin\ProductController@edit')->name('admin_product_edit');
    Route::get('product/change/{id}', 'Admin\ProductController@change')->name('admin_product_change');
    Route::get('product/delete/{id}', 'Admin\ProductController@delete')->name('admin_product_delete');
    Route::get('product/restore/{id}', 'Admin\ProductController@restore')->name('admin_product_restore');
    Route::get('product/delete_force/{id}', 'Admin\ProductController@deleteForce')->name('admin_product_delete_force');
    Route::post('product/save', 'Admin\ProductController@save')->name('ajax_admin_product_save');

    // Static Page
    Route::get('static_page', 'Admin\StaticPageController@index')->name('admin_manage_static_page');
    Route::match(['get', 'post'], 'static_page/edit', 'Admin\StaticPageController@edit')->name('admin_edit_static_page');

    Route::match(['get', 'post'], 'contact/list',        'Admin\ContactPageController@index')->name('admin_manage_contacts');
    Route::match(['get', 'post'], 'contact/view',        'Admin\ContactPageController@view')->name('admin_view_contacts');

    // Order
    Route::match(['get', 'post'], 'order',        'Admin\OrderController@index')->name('admin_manage_order');
});

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'auth.seller']], function () {
    Route::get('dashboard', 'Seller\DashBoardController@index')->name('seller_dashboard');

    // Change password page
    Route::match(['get', 'post'], 'doi-mat-khau', 'Seller\ManageController@changePasswordSeller')->name('seller_change_password');
    // Personal information page
    Route::match(['get'], 'quan-ly-thong-tin-ca-nhan', 'Seller\PersonalInfoController@index')->name('seller_account_management');
    Route::match(['post'], 'quan-ly-thong-tin-ca-nhan/add', 'Seller\PersonalInfoController@add')->name('seller_account_management_add');
    Route::match(['post'], 'quan-ly-thong-tin-ca-nhan/update', 'Seller\PersonalInfoController@update')->name('seller_account_management_update');
    // New post page
    Route::match(['get', 'post'], 'new-post', 'Seller\ManageController@newPost')->name('seller_new_post');
    Route::match(['get', 'post'], 'inbox', 'Seller\ManageController@inbox')->name('seller_inbox');
    Route::match(['get', 'post'], 'manage-order', 'Seller\ManageController@manageOrder')->name('seller_manange_order');

    // Product
    Route::get('product/list', 'Seller\ProductController@index')->name('seller_product_index');
    Route::get('product/create', 'Seller\ProductController@add')->name('seller_product_create');
    Route::get('product/edit/{id}', 'Seller\ProductController@edit')->name('seller_product_edit');
    Route::get('product/clone/{id}', 'Seller\ProductController@copy')->name('seller_product_clone');
    Route::post('product/save', 'Seller\ProductController@save')->name('seller_product_save');
    Route::get('product/delete/{id}', 'Seller\ProductController@delete')->name('seller_product_delete');

    Route::post('favorite', 'Seller\FavoriteController@index')->name('seller_product_favorite');
    Route::get('favorite/lists', 'Seller\FavoriteController@lists')->name('seller_product_favorite_lists');
});
Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'auth.user']], function () {
    Route::get('dashboard', 'User\DashBoardController@index')->name('user_dashboard');

    Route::match(['get', 'post'], 'account-management', 'User\ManageController@accountManagement')->name('user_account_management');
    Route::match(['get', 'post'], 'change-password', 'User\ManageController@changePasswordUser')->name('user_change_password');
    Route::match(['get', 'post'], 'order-history', 'User\ManageController@orderHistory')->name('user_order_history');
//    Route::match(['get', 'post'], 'account_management', 'Seller\ManageController@accountManagement')->name('seller_account_management');

    // Product
    Route::post('favorite', 'User\FavoriteController@index')->name('user_product_favorite');
    Route::get('favorite/lists', 'User\FavoriteController@lists')->name('user_product_favorite_lists');
    Route::match(['get', 'post'], 'shipping', 'User\CheckoutController@index')->name('user_checkout_shipping');

});
//Auth::routes();
