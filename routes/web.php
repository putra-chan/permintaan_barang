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
// User
Route::get('/', 'Index\IndexController@index');

//Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@store');
Route::post('/home/fetch', 'HomeController@fetch');
Route::get('/pr_home', 'HomeController@pr_home');
Route::post('/store', 'Purchasing_Request\IndexController@store');
Route::get('/pr', 'Purchasing_Request\IndexController@pr');
Route::get('/pr/{prcode}', 'Purchasing_Request\IndexController@pr_detail');
Route::post('/pr', 'Purchasing_Request\IndexController@cancel');
Route::post('/add-qty', 'HomeController@addQty');
Route::post('/subtract-qty', 'HomeController@subtractQty');
// Route Admin
Route::get('/admin', 'Admin\AdminController@index');
Route::get('/product', 'Admin\ProductController@product');
Route::post('/product', 'Admin\ProductController@store');
Route::post('/product/delete', 'Admin\ProductController@destroy');
// Approve
Route::get('/approve', 'Approved\ApprovedController@tableApp');
Route::post('/approve', 'Approved\ApprovedController@fetchPR');
Route::post('/success', 'Approved\ApprovedController@success');
Route::post('/reject', 'Approved\ApprovedController@success');
