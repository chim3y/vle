<?php

use App\Notifications\LecturePublished;


Route::get('/', function () {
	$user= App\User::whereHas('roles', function($q){
    $q->where('role_name', 'Student');
})->first();

	$lecture=App\Lecture::first();

   $user->notify(new LecturePublished($lecture));
});

Route::get('/contact', function () {
    return view('pages.contact');
});

//--Users --//
Route::get('/users', array('as' => 'users', 'uses' => 'UsersController@index'));
Route::get('/users/getusersData', array('as' => 'usersData', 'uses' => 'UsersController@usersData'));
Route::get('/users/{id}/{name}', ['as' => 'users.show', 'uses' => 'UsersController@show']);
Route::get('/users/{id}/{name}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::resource('users', 'UsersController');
Route::get('/courses', array('as' => 'courses', 'uses' => 'CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'coursesData', 'uses' => 'CoursesController@coursesData'));
Route::get('programmes/{id}/{course_name}', ['as' => 'courses.show', 'uses' => 'CoursesController@show']);
Route::resource('/courses', 'CoursesController');
//-- HOME Page --//
Route::get('/dashboard', array('as'=>'dashboard','uses' => 'UsersController@showDashboard'));
Auth::routes();

//Tutors
Route::prefix('tutor')->group(function(){
	//tutor courses
Route::get('/courses', array('as' => 'tutor.courses', 'uses' => 'tutor\CoursesController@index',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/courses/getcoursesData', array('as' => 'tutor.coursesData', 'uses' => 'tutor\CoursesController@coursesData',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/courses/create', array('as' => 'tutor.courses.create', 'uses' => 'tutor\CoursesController@create',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::post('/courses', array('as' => 'tutor.courses.store', 'uses' => 'tutor\CoursesController@store',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/courses/{id}/edit', array('as' => 'tutor.courses.edit', 'uses' => 'tutor\CoursesController@edit',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::patch('/courses/{id}/edit', array('as' => 'tutor.courses.update', 'uses' => 'tutor\CoursesController@update',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/courses/{id}', 'tutor\CoursesController@show');
   //tutor dashboard
Route::get('/dashboard', array('as'=>'tutor.dashboard','uses' => 'tutor\TutorController@showDashboard',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
//--Contents --//
Route::get('/contents/{id}/edit', ['as' => 'tutor.contents.edit', 'uses' => 'tutor\ContentController@edit',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::patch('/contents/{id}/edit', ['as' => 'tutor.contents.update', 'uses' => 'tutor\ContentController@update',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::get('/contents/create', ['as' => 'tutor.contents.create', 'uses' => 'tutor\ContentController@create',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::post('/contents', ['as' => 'tutor.contents.store', 'uses' => 'tutor\ContentController@store',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::delete('/contents/{id}', ['as' => 'tutor.contents.delete', 'uses' => 'tutor\ContentController@destroy',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
});

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


//-- Admin --//
Route::group(['prefix' => 'admin',  'middleware' => 'auth:admin'], function(){
Route::get('/dashboard', 'Admin\AdminController@showDashboard')->name('admin.dashboard');
//users
Route::get('/users', array('as' => 'admin.users', 'uses' => 'Admin\UsersController@index'));
Route::get('/users/getusersData', array('as' => 'admin.usersData', 'uses' => 'Admin\UsersController@usersData'));
Route::get('users/{id}/{name}', ['as' => 'admin.users.show', 'uses' => 'Admin\UsersController@show']);
Route::post('users/{id}/{name}', ['as' => 'admin.users.show', 'uses' => 'Admin\UsersController@show']);
Route::get('users/{id}/{name}', ['as' => 'admin.users.edit', 'uses' => 'Admin\UsersController@edit']);

//tutors
Route::get('/tutors', array('as' => 'admin.tutors', 'uses' => 'Admin\TutorsController@index'));
Route::get('/tutors/pendingtutorsData', array('as' => 'admin.pendingtutorsData', 'uses' => 'Admin\TutorsController@pendingtutorsData'));
Route::get('/tutors/approvedtutorsData', array('as' => 'admin.approvedtutorsData', 'uses' => 'Admin\TutorsController@approvedtutorsData'));
Route::get('/tutors/deniedtutorsData', array('as' => 'admin.deniedtutorsData', 'uses' => 'Admin\TutorsController@deniedtutorsData'));
Route::patch('/tutors/{id}', ['as' => 'admin.tutors.update', 'uses' => 'Admin\TutorsController@update']);

Route::get('/tutors/{id}/{name}', ['as' => 'admin.tutors.show', 'uses' => 'Admin\TutorsController@show']);
Route::post('/tutors/{id}/{name}', ['as' => 'admin.tutors.show', 'uses' => 'Admin\TutorsController@show']);
Route::get('/tutors{id}/{name}', ['as' => 'admin.tutors.edit', 'uses' => 'Admin\TutorsController@edit']);
Route::delete('/tutors/{id}', ['as' => 'admin.tutors.delete', 'uses' => 'Admin\TutorsController@destroy']);
//students
Route::get('/students', array('as' => 'admin.students', 'uses' => 'Admin\StudentsController@index'));
Route::get('/students/pendingstudentsData', array('as' => 'admin.pendingstudentsData', 'uses' => 'Admin\StudentsController@pendingstudentsData'));
Route::get('/students/approvedstudentsData', array('as' => 'admin.approvedstudentsData', 'uses' => 'Admin\StudentsController@approvedstudentsData'));
Route::get('/students/deniedstudentsData', array('as' => 'admin.deniedstudentsData', 'uses' => 'Admin\StudentsController@deniedstudentsData'));
Route::patch('/students', 'Admin\StudentsController@update')->name('admin.students.update');
Route::get('/students/{id}/{name}', ['as' => 'admin.students.show', 'uses' => 'Admin\StudentsController@show']);
Route::post('/students/{id}/{name}', ['as' => 'admin.students.show', 'uses' => 'Admin\StudentsController@show']);
Route::get('/students/{id}/{name}', ['as' => 'admin.students.edit', 'uses' => 'Admin\StudentsController@edit']);
Route::patch('/students/{id}', ['as' => 'admin.students.update', 'uses' => 'Admin\StudentsController@update']);
//role assignment
Route::get('/roles/assign', array('as' => 'admin.role.assign', 'uses' => 'Admin\RoleController@assignRole'));

//--Courses --//
Route::get('/courses', array('as' => 'admin.courses', 'uses' => 'Admin\CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'admin.coursesData', 'uses' => 'Admin\CoursesController@coursesData'));
Route::get('/courses/create', 'Admin\CoursesController@create')->name('admin.courses.create');
Route::post('/courses', 'Admin\CoursesController@store')->name('admin.courses.store');
Route::get('/courses/{id}/edit', 'Admin\CoursesController@edit')->name('admin.courses.edit');
Route::patch('/courses/{id}/edit', array('as' => 'admin.courses.update', 'uses' => 'Admin\CoursesController@update'));
Route::get('/courses/{id}', 'Admin\CoursesController@show');
Route::delete('/courses/{id}', ['as' => 'admin.courses.delete', 'uses' => 'Admin\CoursesController@destroy']);
//--Programmes--//
Route::get('/programmes', array('as' => 'admin.programmes', 'uses' => 'Admin\ProgrammesController@index'));
Route::get('/programmes/getprogrammesData', array('as' => 'programmesData', 'uses' => 'Admin\ProgrammesController@programmesData'));

Route::get('/programmes/create', 'Admin\ProgrammesController@create')->name('admin.programmes.create');
Route::post('/programmes', 'Admin\ProgrammesController@store')->name('admin.programmes.store');
Route::get('/programmes/{id}/edit', 'Admin\ProgrammesController@edit')->name('admin.programmes.edit');
Route::patch('/programmes/{id}', 'Admin\ProgrammesController@update')->name('admin.programmes.update');

Route::get('/programmes/{id}/{programme_code}', ['as' => 'admin.programmes.show', 'uses' => 'Admin\ProgrammesController@show']);

//--departments--//
Route::get('/departments', array('as' => 'admin.departments', 'uses' => 'Admin\DepartmentsController@index'));
Route::get('/departments/getdepartmentsData', array('as' => 'admin.departmentsData', 'uses' => 'Admin\DepartmentsController@departmentsData'));
Route::resource('/departments', 'Admin\DepartmentsController');

//--Contents --//

Route::get('/contents/create', ['as' => 'admin.contents.create', 'uses' => 'Admin\ContentController@create']);
Route::post('/contents', ['as' => 'admin.contents.store', 'uses' => 'Admin\ContentController@store']);
Route::get('/contents/{id}/edit', ['as' => 'admin.contents.edit', 'uses' => 'Admin\ContentController@edit']);
Route::patch('/contents/{id}/edit', ['as' => 'admin.contents.update', 'uses' => 'Admin\ContentController@update']);
Route::delete('/contents/{id}', ['as' => 'admin.contents.delete', 'uses' => 'Admin\ContentController@destroy']);



//--quizes --//
Route::get('/contents/{contentId}/quizes/create', ['as' => 'admin.contents.quizes.create', 'uses' => 'Admin\QuizesController@create']);
Route::post('/contents/{contentId}/quizes', ['as' => 'admin.contents.quizes.store', 'uses' => 'Admin\QuizzesController@store']);
Route::get('/contents/{contentId}/quizes/{id}/edit', ['as' => 'admin.contents.quizes.edit', 'uses' => 'Admin\QuizesController@edit']);
Route::patch('/contents/{contentId}/quizes/{id}/edit', ['as' => 'admin.contents.quizes.update', 'uses' => 'Admin\QuizesController@update']);
Route::delete('/contents/{contentId}/quizes', ['as' => 'admin.contents.quizes.delete', 'uses' => 'Admin\QuizesController@destroy']);

//--Lectures--//
Route::get('/contents/{contentId}/lectures/create', ['as' => 'admin.contents.lectures.create', 'uses' => 'Admin\LectureController@create']);
Route::post('/contents/{contentId}/lectures', ['as' => 'admin.contents.lectures.store', 'uses' => 'Admin\LectureController@store']);
Route::get('/contents/{contentId}/lectures/{id}/edit', ['as' => 'admin.contents.lectures.edit', 'uses' => 'Admin\LectureController@edit']);
Route::patch('/contents/{contentId}/lectures/{id}/edit', ['as' => 'admin.contents.lectures.update', 'uses' => 'Admin\LectureController@update']);
Route::delete('/lectures/{id}', ['as' => 'admin.lectures.delete', 'uses' => 'Admin\LectureController@destroy']);
Route::get('/lectures/{id}/{lecture_name}', ['as' => 'admin.lectures.show', 'uses' => 'Admin\LectureController@show']);

//--assignments--//
Route::get('/contents/{contentId}/assignments/create', ['as' => 'admin.contents.assignments.create', 'uses' => 'Admin\AssignmentController@create']);
Route::post('/contents/{contentId}/assignments', ['as' => 'admin.contents.assignments.store', 'uses' => 'Admin\AssignmentController@store']);
Route::get('/contents/{contentId}/assignments/{id}/edit', ['as' => 'admin.contents.assignments.edit', 'uses' => 'Admin\AssignmentController@edit']);
Route::patch('/contents/{contentId}/assignments/{id}/edit', ['as' => 'admin.contents.assignments.update', 'uses' => 'Admin\AssignmentController@update']);
Route::delete('/assignments/{id}', ['as' => 'admin.assignments.delete', 'uses' => 'Admin\AssignmentController@destroy']);
Route::get('/assignments/{id}/{assignment_title}', ['as' => 'admin.assignments.show', 'uses' => 'Admin\AssignmentController@show']);


//--videos--//
Route::get('/contents/{contentId}/videos/create', ['as' => 'admin.contents.videos.create', 'uses' => 'Admin\VideoController@create']);
Route::post('/contents/{contentId}/videos', ['as' => 'admin.contents.videos.store', 'uses' => 'Admin\VideoController@store']);
Route::get('/contents/{contentId}/videos/{id}/edit', ['as' => 'admin.contents.videos.edit', 'uses' => 'Admin\VideoController@edit']);
Route::patch('/contents/{contentId}/videos/{id}/edit', ['as' => 'admin.contents.videos.update', 'uses' => 'Admin\VideoController@update']);
Route::delete('/contents/{contentId}/videos/{id}', ['as' => 'admin.contents.videos.delete', 'uses' => 'Admin\VideoController@destroy']);


});



//Student
Route::prefix('student')->group(function(){

//Dashboard
Route::get('/dashboard', array('as'=>'student.dashboard','uses' => 'student\StudentController@showDashboard',
	'middleware'=>'roles',
	'roles'=>['Student']));
//--Courses --//
Route::get('/courses', array('as' => 'student.courses', 'uses' => 'student\CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'student.coursesData', 'uses' => 'student\CoursesController@coursesData'));
Route::get('/courses/{id}', array('as' => 'student.courses.show', 'uses' =>  'student\CoursesController@show'));
Route::post('/courses/enroll', array('as' => 'student.courses.enroll', 'uses' => 'student\CoursesController@enroll'));

//Route::get('programmes/{id}/{course_name}', ['as' => 'admin.courses.show', 'uses' => 'Admin\CoursesController@show']);
//--Semesters --//
Route::resource('semesters', 'admin\SemesterController');


//--Lectures--//
Route::get('contents/{id}/lectures/create', 'LectureController@create');
Route::post('lectures', 'LectureController@store');
Route::get('lectures/{id}/edit', 'LectureController@edit');
Route::post('contents/{id}/edit', 'LectureController@update');
Route::get('contents/{id}', 'LectureController@destroy');

//--Quizes --//
Route::resource('contents.quizes', 'QuizesController');

});




