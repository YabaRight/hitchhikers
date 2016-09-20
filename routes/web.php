<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','PageController@home');
Route::get('/home','PageController@home');
Route::get('/index','PageController@home');
Route::post('/search','PageController@search');
Route::get('/near_me','PageController@near_me');
Route::get('/get_map_direction/{x}/{y}','PageController@get_map_direction');
Route::get('/get_map_direction/{x}','PageController@get_map_direction');
Route::get('/get_map_direction','PageController@get_map_direction');
Route::get('/biz/{id}','AdminController@biz_view');
Route::post('ajax/saveLocationToSession/','AdminController@saveLocationToSession');




Route::group(['middleware' => 'auth'], function () {

Route::get('/admin','AdminController@home');
Route::get('/all_categories','AdminController@all_categories');
Route::get('/all_categories_property','AdminController@all_categories_property');
Route::post('/admin/add_category','AdminController@post_add_categories');
Route::post('/admin/add_property','AdminController@post_add_property');
Route::post('/admin/edit_category','AdminController@post_edit_category');
Route::post('admin/update_category','AdminController@update_category');
Route::post('admin/update_property','AdminController@update_property');
Route::get('/admin/delete_category/{id}','AdminController@delete_category');
Route::get('/admin/delete_property/{id}','AdminController@delete_property');
Route::get('/admin/modify_category_property/{id}','AdminController@modify_category_property');

Route::get('/create_business','AdminController@create_business');
Route::get('admin/biz/{id}','AdminController@view_biz');

Route::get('admin/report','AdminController@report');
Route::get('admin/view_category/{id}','AdminController@view_category_details');

Route::get('admin/edit_biz/{id}','AdminController@edit_biz');
Route::post('admin/update_business','AdminController@update_business');
Route::get('admin/update_imgs/{listing_id}/{img}', 'AdminController@update_imgs');

Route::post('admin/update_biz','AdminController@update_biz');
Route::post('admin/update_image','AdminController@update_image');
Route::post('admin/create_business','AdminController@post_create_business');
Route::get('admin/delete_biz/{id}','AdminController@delete_biz');

Route::get('/all_businesses','AdminController@all_businesses');


Route::get('/hits','AdminController@hits');
});

// My Authentication routes...
Route::post('/auth/login', 'Auth\LoginController@login');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'PageController@login');
});

Route::get('/auth/logout', 'Auth\LoginController@logout');


//AJAX
Route::get('/admin/ajax/get_cat_property_edit/{id}/{listing_id}','AdminController@get_cat_property_edit');
Route::get('/admin/ajax/get_cat_property/{id}','AdminController@get_cat_property');
Route::get('/admin/ajax/get_biz_property/{id}','AdminController@get_biz_property');



// API
Route::get('api/search/{token}', 'ApiController@search');
Route::post('api/search', 'ApiController@postsearch');


// external links 
Route::get('external/create_business','AdminController@external_create_business');


 