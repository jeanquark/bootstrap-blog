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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('home', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('about', array('as' => 'about', 'uses' => 'HomeController@about'));
    Route::get('services', array('as' => 'services', 'uses' => 'HomeController@services'));
	Route::get('contact', array('as' => 'contact', 'uses' => 'HomeController@contact'));
	Route::post('contact', array('as' => 'store_contact', 'uses' => 'HomeController@store_contact'));
	Route::get('search', array('as' => 'search', 'uses' => 'BlogController@search'));
	Route::get('post/{slug}', array('as' => 'post', 'uses' => 'BlogController@showPost'));
	Route::post('posts/publishedStatus', array('as' => 'publishedStatus', 'uses' => 'PostController@publishedStatus'));
	Route::post('post/{slug}/comment', array('as' => 'post.comment', 'uses' => 'BlogController@comment'));
	Route::post('post/{id}/reply', array('as' => 'post.reply', 'uses' => 'BlogController@reply'));
	Route::get('tag/{slug}', array('as' => 'showTaggedPost', 'uses' => 'BlogController@showTaggedPost'));
	Route::get('user/{hash}', array('as' => 'showUserPost', 'uses' => 'BlogController@showUserPost'));
});

Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {
	Route::get('admin', array('as' => 'index', 'uses' => 'AdminController@index'));
	Route::resource('admin/post', 'PostController');
	Route::resource('admin/tag', 'TagController');
	Route::resource('admin/comment', 'CommentController');
	Route::resource('admin/reply', 'ReplyController');
	Route::resource('admin/user', 'UserController');
	Route::resource('admin/contact', 'ContactController', ['only' => [
	    'index', 'create', 'show', 'destroy'
	]]);
	Route::post('admin/contact/readStatus', array('as' => 'readStatus', 'uses' => 'ContactController@readStatus'));
});