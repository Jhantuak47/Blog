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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::resource('post','PostsController');
Route::post('/upload_profile_pics','UsersController@upload_profile_pics');

Route::get('/profile', function () {
        return view('profilepics');
});
Route::post('/edit_post',"PostsController@update_status")->name('edit_post');
Route::post('/upload', 'ImageController@upload')->name('upload');
Route::get('/pagination', 'PostsController@paginate')->name('pagination')->middleware('auth','role');
