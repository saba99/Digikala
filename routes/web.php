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

//FRONTEND

Route::get('/', 'Frontend\SiteController@index');




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


    //WARRANTIES 

    Route::post('warranties/remove_items', 'Admin\WarrantyController@remove_items');

    Route::post('warranties/restore_items', 'Admin\WarrantyProductController@restore_items');

    Route::resource('warranties', 'Admin\WarrantyController');

    Route::post('warranties/{warranties}', 'Admin\WarrantyController@restore');

//PRODUCT WARRANTIES 

    Route::post('product_warranties/remove_items', 'Admin\ProductWarrantyController@remove_items');

    Route::post('product_warranties/restore_items', 'Admin\ProductWarrantyProductController@restore_items');

    Route::resource('product_warranties', 'Admin\ProductWarrantyController');

    Route::post('product_warranties/{warranties}', 'Admin\ProductWarrantyController@restore');

 

    Route::get('products/gallery/{id}','Admin\ProductController@gallery');

    Route::post('products/gallery_upload/{id}','Admin\ProductController@upload');

    Route::delete('products/gallery/{id}','Admin\ProductController@removeImageGallery');

    Route::post('products/change_images_status/{id}', 'Admin\ProductController@change_images_status');


    //SLIDERS 


    Route::post('sliders/remove_items', 'Admin\SliderController@remove_items');

    Route::post('sliders/restore_items', 'Admin\SliderProductController@restore_items');

    Route::resource('sliders', 'Admin\SliderController');

    Route::post('sliders/{warranties}', 'Admin\SliderController@restore');


    //ITEMS

    Route::get('category/{id}/items','Admin\ItemController@items');

    Route::post('category/{id}/item', 'Admin\ItemController@add_items');

    Route::delete('category/items/{id}', 'Admin\ItemController@destroy');

//PRODUCT ITEMS 
    Route::get('products/{id}/items','Admin\ProductController@items');


    Route::post('products/{id}/items', 'Admin\ProductController@add_items');

    Route::get('products/{id}/filters', 'Admin\ProductController@filters');


    Route::post('products/{id}/filters', 'Admin\ProductController@add_filters');


    //FILTER 
    Route::get('category/{id}/filters', 'Admin\FilterController@filters');

    Route::post('category/{id}/filters', 'Admin\FilterController@add_filters');

    Route::delete('category/filters/{id}', 'Admin\FilterController@destroy');




});



