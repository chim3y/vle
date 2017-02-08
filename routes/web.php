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
    return view('home');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/login', function () {
    return view('pages.login');
});


//-- Admin --//

Route::get('/admin/dashboard', function () {
     return view('admin.dashboard');
});


//--Courses --//


//--Users --//
Route::get('/admin/users', [
    'as'=>'index',
    'uses'=>'UsersController@index']
	);
			
Route::get('/admin/users/postusers', [
	 'as'=>'postusers',
    'uses'=>'UsersController@postusers'] );
			