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

// //CATEGORY
 Route::post('category/remove_items', 'Admin\CategoryController@remove_items');

 Route::post('category/restore_items', 'Admin\CategoryController@restore_items');

 Route::resource('category', 'Admin\CategoryController');

    Route::post('category/{category}', 'Admin\CategoryController@restore');

// //BRAND
     Route::post('brands/remove_items', 'Admin\BrandController@remove_items');

    Route::post('brands/restore_items', 'Admin\BrandController@restore_items');

    Route::resource('brands', 'Admin\BrandController');

     Route::post('brands/{brands}', 'Admin\BrandController@restore');

//     //COLOR 

     Route::post('colors/remove_items', 'Admin\ColorController@remove_items');

   Route::post('colors/restore_items', 'Admin\ColorController@restore_items');

    Route::resource('colors', 'Admin\ColorController');

 Route::post('colors/{colors}', 'Admin\ColorController@restore');

    //PRODUCT
    Route::post('products/remove_items', 'Admin\ProductController@remove_items');

    Route::post('products/restore_items', 'Admin\ProductProductController@restore_items');

    Route::resource('products', 'Admin\ProductController');

    Route::post('products/{products}', 'Admin\ProductController@restore');


    //crud helpers function

    // create_crud_route('category','CategoryController');
    // create_crud_route('brands', 'BrandController');
    // create_crud_route('colors', 'ColorController');
    // create_crud_route('products', 'ProductController',true);

    



});



