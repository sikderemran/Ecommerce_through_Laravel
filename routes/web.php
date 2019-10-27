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
/* fontend view */
Route::get('/','homeController@index');

/* Backend */
Route::get('/logout','superAdminController@logout');
Route::get('/admin','adminController@index');
Route::get('/dashboard','superAdminController@index');
Route::get('/admin-dashboard','adminController@dashboard');
Route::get('/addCategory','categoryController@index');
Route::get('/allCategory','categoryController@allCategory');
Route::get('/saveCategory','categoryController@saveCategory');
Route::get('/unactive_category/{category_id}','categoryController@unactive_category');
Route::get('/active_category/{category_id}','categoryController@active_category');
Route::get('/edit_category/{category_id}','categoryController@edit_category');
Route::get('/delete_category/{category_id}','categoryController@delete_category');
Route::post('/update_category/{category_id}','categoryController@update_category');
Route::get('/addBrand','brandController@addBrand');
Route::get('/saveBrand','brandController@saveBrand');
Route::get('/allBrand','brandController@allBrand');
Route::get('/deactive_brand/{manufacture_id}','brandController@deactive_brand');
Route::get('/active_brand/{manufacture_id}','brandController@active_brand');
Route::get('/delete_brand/{manufacture_id}','brandController@delete_brand');
Route::get('/edit_brand/{manufacture_id}','brandController@edit_brand');
Route::post('/update_brand/{manufacture_id}','brandController@update_brand');
Route::get('/add_product','productController@add_product');
Route::post('/save_product','productController@save_product');
Route::get('/all_product','productController@all_product');
Route::get('/unactive_product/{product_id}','productController@unactive_product');
Route::get('/active_product/{product_id}','productController@active_product');
Route::get('/delete_product/{product_id}','productController@delete_product');
Route::get('/edit_product/{product_id}','productController@edit_product');
Route::post('/update_product/{product_id}','productController@update_product');
Route::get('/add_slider','sliderController@add_slider');
Route::post('/save_slider','sliderController@save_slider');
Route::get('/all_slider','sliderController@all_slider');
Route::get('/unactive_slider/{slider_id}','sliderController@unactive_slider');
Route::get('/active_slider/{slider_id}','sliderController@active_slider');
Route::get('/delete_slider/{slider_id}','sliderController@delete_slider');
Route::get('/product_by_category/{category_id}','homeController@product_by_category');
Route::get('/product_by_manufacture/{brand_id}','homeController@product_by_manufacture');
Route::get('/view_product/{product_id}','homeController@product_details');
Route::post('/add_to_cart','cartController@add_to_cart');
Route::get('/show_cart','cartController@show_cart');
Route::get('/delete_to_cart/{rowId}','cartController@delete_to_cart');
Route::post('/update_cart','cartController@update_cart');
Route::get('/login_check','checkoutController@login_check');
Route::post('/customer_registration','checkoutController@customer_registration');
Route::get('/checkout','checkoutController@checkout');
Route::post('/save_shipping_details','checkoutController@save_shipping_details');
Route::get('/customer_logout','checkoutController@customer_logout');
Route::post('/customer_login','checkoutController@customer_login');
Route::get('/payment','checkoutController@payment');
Route::post('/order_place','checkoutController@order_place');
Route::get('/manage_order','checkoutController@manage_order');
Route::get('/view_order/{order_id}','checkoutController@view_order');