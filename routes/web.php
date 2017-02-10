<?php

//-- HOME Page --//

Route::get('/', function () {
    return view('index');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/login', function () {
    return view('pages.login');
});



//-- Admin --//

Route::get('/dashboard', function () {
     return view('admin.dashboard');
});



//--Courses --//
Route::get('/courses', array('as' => 'courses', 'uses' => 'CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'coursesData', 'uses' => 'CoursesController@coursesData'));

Route::get('/courses/create', 'CoursesController@create');
Route::post('/courses', 'CoursesController@store');

//--Users --//
Route::get('/users', array('as' => 'users', 'uses' => 'UsersController@index'));
Route::get('/users/getusersData', array('as' => 'usersData', 'uses' => 'UsersController@usersData'));

Route::get('/users/create', 'UsersController@create');
Route::post('/users', 'UsersController@store');


//-- Authentication --//	
Auth::routes();

Route::get('/home', 'HomeController@index');
