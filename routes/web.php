<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['prefix'=>'blog'],function(){
Auth::routes();

Route::get('/','PostController@index')->name('index');
Route::get('list','PostController@blog_list')->name('blog_list');
Route::get('add','PostController@add_blog')->name('add_blog');
Route::post('save','PostController@save_blog')->name('save_blog');
Route::get('view/{id?}','PostController@view_post')->name('view_post');
Route::get('edit/{id?}','PostController@edit_post')->name('edit_post');
Route::post('update','PostController@update_blog')->name('update_blog');
Route::post('delete','PostController@delete_blog')->name('delete_blog');

});


// Route::get('/home', 'HomeController@index')->name('home');
