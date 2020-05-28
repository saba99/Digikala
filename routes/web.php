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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){

Route::get('/','Admin\AdminController@index');


Route::post('category/remove_items', 'Admin\CategoryController@remove_items');

Route::post('category/restore_items', 'Admin\CategoryController@restore_items');

Route::resource('category', 'Admin\CategoryController');

    Route::post('category/{category}', 'Admin\CategoryController@restore');


    Route::post('brands/remove_items', 'Admin\BrandController@remove_items');

    Route::post('brands/restore_items', 'Admin\BrandController@restore_items');

    Route::resource('brands', 'Admin\BrandController');

    Route::post('brands/{brands}', 'Admin\BrandController@restore');
});



