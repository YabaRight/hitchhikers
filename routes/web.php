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
Route::get('/biz/{id}','AdminController@biz_view');


Route::get('/admin','AdminController@home');
Route::get('/all_categories','AdminController@all_categories');
Route::post('/admin/add_category','AdminController@post_add_categories');
Route::post('/admin/edit_category','AdminController@post_edit_category');
Route::post('admin/update_category','AdminController@update_category');
Route::get('/admin/delete_category/{id}','AdminController@delete_category');

Route::get('/create_business','AdminController@create_business');
Route::get('admin/biz/{id}','AdminController@view_biz');
Route::post('admin/update_biz','AdminController@update_biz');
Route::post('admin/update_image','AdminController@update_image');
Route::post('admin/create_business','AdminController@post_create_business');
Route::get('admin/delete_biz/{id}','AdminController@delete_biz');

Route::get('/all_businesses','AdminController@all_businesses');


Route::get('/hits','AdminController@hits');



// My Authentication routes...
Route::post('/auth/login', 'Auth\LoginController@login');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'PageController@login');
});

Route::get('/auth/logout', 'Auth\LoginController@logout');


// API
Route::get('api/search/{token}', 'ApiController@search');
Route::post('api/search', 'ApiController@postsearch');


// Auth::routes();

// Route::get('/home', 'HomeController@index');

// Auth::routes();

// Route::get('/home', 'HomeController@index');
