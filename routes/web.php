<?php

//-- HOME Page --//
Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/contact', function () {
    return view('pages.contact');
});


//-- Authentication --//	



//-- Admin --//

Route::get('/dashboard', 'AdminController@showDashboard');


//--departments--//
Route::get('/departments', array('as' => 'departments', 'uses' => 'DepartmentsController@index'));
Route::get('/departments/getdepartmentsData', array('as' => 'departmentsData', 'uses' => 'DepartmentsController@departmentsData'));
Route::resource('/departments', 'DepartmentsController');

//--Programmes--//
Route::get('/programmes', array('as' => 'programmes', 'uses' => 'ProgrammesController@index'));
Route::get('/programmes/getprogrammesData', array('as' => 'programmesData', 'uses' => 'ProgrammesController@programmesData'));
Route::get('programmes/{id}/{programme_code}', ['as' => 'programmes.show', 'uses' => 'ProgrammesController@show']);
Route::resource('/programmes', 'ProgrammesController');


//--Courses --//
Route::get('/courses', array('as' => 'courses', 'uses' => 'CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'coursesData', 'uses' => 'CoursesController@coursesData'));
Route::resource('/courses', 'CoursesController');


//--Users --//
Route::get('/users', array('as' => 'users', 'uses' => 'UsersController@index'));
Route::get('/users/getusersData', array('as' => 'usersData', 'uses' => 'UsersController@usersData'));
Route::get('users/{id}/{name}', ['as' => 'users.show', 'uses' => 'UsersController@show']);
Route::get('users/{id}/{name}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::resource('users', 'UsersController');





