<?php

use App\Notifications\AssignmentSubmitted;


Route::get('/', function () {
	$course=App\Course::all();
	$coursename=App\Course::pluck('course_name')->toArray();
	$student=App\Student::where('isApproved',1)->get();
	$departments=App\Department::all();
	$tutors=App\Tutor::where('isApproved',1)->get();
	foreach($tutors as $t){
			$tutoruser=App\User::where('id', $t->user_id)->pluck('name')->toArray();
	}

    return view('index', compact('course', $course))->withStudent($student)->withDepartments($departments)->withtutors($tutors)->withCoursename($coursename)->withTutoruser($tutoruser);
});


Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('download/{file}', 'tutor\AssignmentController@download');
Route::get('download/{file}', 'Admin\LectureController@download');
Route::get('downloadsub/{filename}' , array('as'=>'assignments.submissions','uses' => 'student\AssignmentSubmissionController@downloadsub'));

//--Users --//
Route::get('/changepassword', function() {return view('users.change-password'); });
Route::post('/changepassword', 'Auth\UpdatePasswordController@update');

Route::get('/users', array('as' => 'users', 'uses' => 'UsersController@index'));
Route::get('/users/getusersData', array('as' => 'usersData', 'uses' => 'UsersController@usersData'));
Route::get('/users/{id}/{name}/profile', ['as' => 'users.show', 'uses' => 'UsersController@show', 'middleware'=>'auth']);
Route::get('/users/{id}/{name}/profile', ['as' => 'users.show', 'uses' => 'UsersController@show','middleware'=> 'auth:admin']);

Route::get('/users/{id}/{name}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::patch('/users/{id}/{name}', ['as' => 'users.edit', 'uses' => 'UsersController@update']);
Route::delete('/users/{id}/{name}', ['as' => 'users.edit', 'uses' => 'UsersController@destroy']);

Route::get('/courses', array('as' => 'courses', 'uses' => 'CoursesController@index'));
Route::get('/courses/getcoursesData', array('as' => 'coursesData', 'uses' => 'CoursesController@coursesData'));
Route::get('programmes/{id}/{course_name}', ['as' => 'courses.show', 'uses' => 'CoursesController@show']);
Route::resource('/courses', 'CoursesController', ['except'=>['edit', 'update', 'destroy']]);
//-- HOME Page --//
Route::get('/dashboard', array('as'=>'dashboard','uses' => 'UsersController@showDashboard'));
Auth::routes();

//tutors
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

Route::delete('/courses/{id}', ['as' => 'tutor.courses.delete', 'uses' => 'tutor\CoursesController@destroy',
	'middleware'=>'roles',
	'roles'=>['Tutor']  ]);

Route::get('/courses/{id}', array('as' => 'tutor.courses.show', 'uses' =>  'tutor\CoursesController@show', 'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::match(['get', 'post'],'/courses/{id}/enroll', array('as' => 'tutor.courses.enroll', 'uses' => 'tutor\CoursesController@enroll', 'middleware'=>'roles',
	'roles'=>['Tutor']));

//student 
Route::get('/students', array('as' => 'tutor.courses', 'uses' => 'tutor\StudentsController@index',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/students/getstudentsData', array('as' => 'tutor.coursesData', 'uses' => 'tutor\StudentsController@studentsData',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/students/create', array('as' => 'tutor.students.create', 'uses' => 'tutor\StudentsController@create',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::post('/students', array('as' => 'tutor.courses.store', 'uses' => 'tutor\StudentsController@store',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::get('/students/{id}/edit', array('as' => 'tutor.students.edit', 'uses' => 'tutor\StudentsController@edit',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::patch('/students/{id}/edit', array('as' => 'tutor.students.update', 'uses' => 'tutor\StudentsController@update',
	'middleware'=>'roles',
	'roles'=>['Tutor']));
Route::delete('/students/{id}', ['as' => 'tutor.students.delete', 'uses' => 'tutor\StudentsController@destroy',
	'middleware'=>'roles',
	'roles'=>['Tutor']  ]);



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

//--Lectures--//
Route::get('/contents/{contentId}/lectures/create', ['as' => 'tutor.contents.lectures.create', 'uses' => 'tutor\LectureController@create',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::post('/contents/{contentId}/lectures', ['as' => 'tutor.contents.lectures.store', 'uses' => 'tutor\LectureController@store',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::get('/contents/{contentId}/lectures/{id}/edit', ['as' => 'tutor.contents.lectures.edit', 'uses' => 'tutor\LectureController@edit',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::patch('/contents/{contentId}/lectures/{id}/edit', ['as' => 'tutor.contents.lectures.update', 'uses' => 'tutor\LectureController@update',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::delete('/lectures/{id}', ['as' => 'tutor.lectures.delete', 'uses' => 'tutor\LectureController@destroy',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);
Route::get('/lectures/{id}/{lecture_name}', ['as' => 'tutor.lectures.show', 'uses' => 'tutor\LectureController@show',
	'middleware'=>'roles',
	'roles'=>['Tutor']]);




//--assignments--//
Route::get('/contents/{contentId}/assignments/create', ['as' => 'tutor.contents.assignments.create', 'uses' => 'tutor\AssignmentController@create']);
Route::patch('/contents/{contentId}/assignments/{id}/edit', ['as' => 'tutor.contents.assignments.update', 'uses' => 'tutor\AssignmentController@update']);
Route::post('/contents/{contentId}/assignments', ['as' => 'tutor.contents.assignments.store', 'uses' => 'tutor\AssignmentController@store']);
Route::get('/contents/{contentId}/assignments/{id}/edit', ['as' => 'tutor.contents.assignments.edit', 'uses' => 'tutor\AssignmentController@edit']);

Route::delete('/assignments/{id}', ['as' => 'tutor.assignments.delete', 'uses' => 'tutor\AssignmentController@destroy']);
Route::get('/contents/{contentId}/assignments/{id}/{assignment_title}', ['as' => 'tutor.assignments.show', 'uses' => 'tutor\AssignmentController@show']);

//--quizes --//
Route::get('/contents/{contentId}/quizes/create', ['as' => 'tutor.contents.quizes.create', 'uses' => 'tutor\QuizesController@create']);
Route::post('/contents/{contentId}/quizes', ['as' => 'tutor.contents.quizes.store', 'uses' => 'tutor\QuizesController@store']);
Route::get('/contents/{contentId}/quizes/{id}/edit', ['as' => 'tutor.contents.quizes.edit', 'uses' => 'tutor\QuizesController@edit']);
Route::patch('/contents/{contentId}/quizes/{id}/edit', ['as' => 'tutor.contents.quizes.update', 'uses' => 'tutor\QuizesController@update']);
Route::delete('/contents/{contentId}/quizes', ['as' => 'tutor.contents.quizes.delete', 'uses' => 'tutor\QuizesController@destroy']);
Route::get('/quizes/{id}/{quiz_name}', ['as' => 'tutor.quiz.show', 'uses' => 'tutor\QuizesController@show']);
Route::get('/contents/{contentId}/quizes/{id}/getquestionsData', array('as' => 'tutor.contents.quizes.questionsData', 'uses' => 'tutor\QuizesController@questionsData'));

//--attempt quiz--//

Route::get('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'tutor.quiz.attemptquiz', 'uses' => 'tutor\AttemptQuizController@create']);

Route::post('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'tutor.quiz.attemptquiz.store', 'uses' => 'tutor\AttemptQuizController@store']);

Route::get('/quiz/{quizId}/{quiz_name}/attemptquiz/{id}/result', ['as' => 'tutor.quiz.attemptquiz.result', 'uses' => 'tutor\AttemptQuizController@edit']);

//--questions --//
Route::get('/questions/{type}/create', ['as' => 'tutor.questions.create', 'uses' => 'tutor\QuestionsController@create']);
Route::post('/questions/{type}', ['as' => 'tutor.questions.type.store', 'uses' => 'tutor\QuestionsController@store']);
Route::get('/questions/getquestionsData', array('as' => 'tutor.questionsData', 'uses' => 'tutor\QuestionsController@questionsData'));
Route::get('/questions/{id}/edit', 'tutor\QuestionsController@edit')->name('tutor.questions.edit');
Route::patch('/questions/{id}/edit', array('as' => 'tutor.questions.update', 'uses' => 'tutor\QuestionsController@update'));
Route::delete('/questions/{id}', ['as' => 'tutor.questions.delete', 'uses' => 'tutor\QuestionsController@destroy']);


//--assignments--//
Route::get('/contents/{contentId}/assignments/create', ['as' => 'tutor.contents.assignments.create', 'uses' => 'tutor\AssignmentController@create', 'middleware'=>'roles',
	'roles'=>['tutor']]);
Route::patch('/contents/{contentId}/assignments/{id}/edit', ['as' => 'tutor.contents.assignments.update', 'uses' => 'tutor\AssignmentController@update' , 'middleware'=>'roles',
	'roles'=>['tutor']]);
Route::post('/contents/{contentId}/assignments', ['as' => 'tutor.contents.assignments.store', 'uses' => 'tutor\AssignmentController@store', 'middleware'=>'roles',
	'roles'=>['tutor']]);
Route::get('/contents/{contentId}/assignments/{id}/edit', ['as' => 'tutor.contents.assignments.edit', 'uses' => 'tutor\AssignmentController@edit', 'middleware'=>'roles',
	'roles'=>['tutor']]);

//--assignmentsubmission grade--//
Route::get('contents/{contentId}/assignment/{id}/assignmentsubmission/getsubmissionData', array('as' => 'tutor.submissionData', 'uses' => 'tutor\AssignmentController@submissionData'));
Route::get('contents/{contentId}/assignment/{assignmentId}/assignmentsubmission/{id}', array('as' => 'tutor.contents.assignment.assignmentsubmission.view', 'uses' => 'tutor\AssignmentController@view'));
Route::PATCH('contents/{contentId}/assignment/{assignmentId}/assignmentsubmission/{id}', array('as' => 'tutor.contents.assignment.assignmentsubmission.update', 'uses' => 'tutor\AssignmentSubmissionController@update'));



Route::delete('/assignments/{id}', ['as' => 'tutor.assignments.delete', 'uses' => 'tutor\AssignmentController@destroy']);
Route::get('/contents/{contentId}/assignment/{assignmentId}/{assignment_title}', ['as' => 'tutor.assignments.show', 'uses' => 'tutor\AssignmentController@show', 'middleware'=>'roles',
	'roles'=>['tutor']]);



//--videos--//
Route::get('/contents/{contentId}/videos/create', ['as' => 'tutor.contents.videos.create', 'uses' => 'tutor\VideoController@create']);
Route::post('/contents/{contentId}/videos', ['as' => 'tutor.contents.videos.store', 'uses' => 'tutor\VideoController@store']);
Route::get('/contents/{contentId}/videos/{id}/edit', ['as' => 'tutor.contents.videos.edit', 'uses' => 'Admin\VideoController@edit']);
Route::patch('/contents/{contentId}/videos/{id}/edit', ['as' => 'tutor.contents.videos.update', 'uses' => 'tutor\VideoController@update']);
Route::delete('/contents/{contentId}/videos/{id}', ['as' => 'tutor.contents.videos.delete', 'uses' => 'tutor\VideoController@destroy']);



});






Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

  Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
//-- Admin --//
Route::group(['prefix' => 'admin',  'middleware' => 'auth:admin'], function(){
Route::get('/dashboard', 'Admin\AdminController@showDashboard')->name('admin.dashboard');
//users
Route::get('/users', array('as' => 'admin.users', 'uses' => 'Admin\UsersController@index'));
Route::get('/users/getusersData', array('as' => 'admin.usersData', 'uses' => 'Admin\UsersController@usersData'));
Route::get('/users/{id}/{name}/view', ['as' => 'admin.users.view', 'uses' => 'Admin\UsersController@view']);
Route::get('/users/{id}/{name}/edit', ['as' => 'admin.users.edit', 'uses' => 'Admin\UsersController@edit']);
Route::get('/users/create', ['as' => 'admin.users.create', 'uses' => 'Admin\UsersController@create']);
Route::post('/users/store', ['as' => 'admin.users.store', 'uses' => 'Admin\UsersController@store']);

Route::get('/assignmentsubmission/getsubmissionData', array('as' => 'admin.submissionData', 'uses' => 'Admin\AssignmentController@submissionData'));
//tutors
Route::get('/tutors', array('as' => 'admin.tutors', 'uses' => 'Admin\TutorsController@index'));
Route::get('/tutors/pendingtutorsData', array('as' => 'admin.pendingtutorsData', 'uses' => 'Admin\TutorsController@pendingtutorsData'));
Route::get('/tutors/approvedtutorsData', array('as' => 'admin.approvedtutorsData', 'uses' => 'Admin\TutorsController@approvedtutorsData'));
Route::get('/tutors/deniedtutorsData', array('as' => 'admin.deniedtutorsData', 'uses' => 'Admin\TutorsController@deniedtutorsData'));
Route::patch('/tutors/{id}', ['as' => 'admin.tutors.update', 'uses' => 'Admin\TutorsController@update']);

Route::get('/tutors/{id}/{name}', ['as' => 'admin.tutors.show', 'uses' => 'Admin\TutorsController@show']);
Route::get('/tutors{id}/{name}', ['as' => 'admin.tutors.edit', 'uses' => 'Admin\TutorsController@edit']);
Route::post('/tutors/{id}/create', ['as' => 'admin.tutors.create', 'uses' => 'Admin\TutorsController@create']);
Route::delete('/tutors/{id}', ['as' => 'admin.tutors.delete', 'uses' => 'Admin\TutorsController@destroy']);
Route::delete('/tutoruser/{userid}', ['as' => 'admin.tutors.deleteuser', 'uses' => 'Admin\TutorsController@deleteuser']);
Route::get('/courses/getcoursesData', array('as' => 'admin.coursesData', 'uses' => 'Admin\CoursesController@coursesData'));

//students
Route::get('/students', array('as' => 'admin.students', 'uses' => 'Admin\StudentsController@index'));
Route::get('/students/pendingstudentsData', array('as' => 'admin.pendingstudentsData', 'uses' => 'Admin\StudentsController@pendingstudentsData'));
Route::get('/students/approvedstudentsData', array('as' => 'admin.approvedstudentsData', 'uses' => 'Admin\StudentsController@approvedstudentsData'));
Route::get('/students/deniedstudentsData', array('as' => 'admin.deniedstudentsData', 'uses' => 'Admin\StudentsController@deniedstudentsData'));
Route::patch('/students/{id}', ['as' => 'admin.students.update', 'uses' => 'Admin\StudentsController@update']);
Route::get('/students/{id}/{name}', ['as' => 'admin.students.show', 'uses' => 'Admin\StudentsController@show']);
Route::get('/students/{id}/{name}', ['as' => 'admin.students.edit', 'uses' => 'Admin\StudentsController@edit']);
Route::post('/students/{id}/create', ['as' => 'admin.tutors.create', 'uses' => 'Admin\StudentsController@create']);
Route::delete('/students/{id}', ['as' => 'admin.students.delete', 'uses' => 'Admin\StudentsController@destroy']);
Route::delete('/studentuser/{userid}', ['as' => 'admin.students.deleteuser', 'uses' => 'Admin\StudentsController@deleteuser']);





Route::get('/roles/assign', array('as' => 'admin.role.assign', 'uses' => 'Admin\RoleController@assignRole'));

//--Courses --//
Route::get('/courses', array('as' => 'admin.courses', 'uses' => 'Admin\CoursesController@index'));

Route::get('/courses/create', 'Admin\CoursesController@create')->name('admin.courses.create');
Route::post('/courses', 'Admin\CoursesController@store')->name('admin.courses.store');
Route::get('/courses/{id}/edit', 'Admin\CoursesController@edit')->name('admin.courses.edit');
Route::patch('/courses/{id}/edit', array('as' => 'admin.courses.update', 'uses' => 'Admin\CoursesController@update'));
Route::get('/courses/{id}', 'Admin\CoursesController@show');
Route::delete('/courses/{id}', ['as' => 'admin.courses.delete', 'uses' => 'Admin\CoursesController@destroy']);
//--Semesters --//
Route::resource('/semesters', 'admin\SemesterController', ['except'=>'delete']);
Route::delete('/semesters/{id}', ['as' => 'admin.semesters.delete', 'uses' => 'Admin\SemesterController@destroy']);

//--Programmes--//
Route::get('/programmes', array('as' => 'admin.programmes', 'uses' => 'Admin\ProgrammesController@index'));
Route::get('/programmes/getprogrammesData', array('as' => 'programmesData', 'uses' => 'Admin\ProgrammesController@programmesData'));

Route::get('/programmes/create', 'Admin\ProgrammesController@create')->name('admin.programmes.create');
Route::post('/programmes', 'Admin\ProgrammesController@store')->name('admin.programmes.store');
Route::get('/programmes/{id}/edit', 'Admin\ProgrammesController@edit')->name('admin.programmes.edit');
Route::patch('/programmes/{id}', 'Admin\ProgrammesController@update')->name('admin.programmes.update');

Route::get('/programmes/{id}/{programme_code}', ['as' => 'admin.programmes.show', 'uses' => 'Admin\ProgrammesController@show']);

Route::delete('/programmes/{id}', ['as' => 'admin.programmes.delete', 'uses' => 'Admin\ProgrammesController@destroy']);
//--departments--//
Route::get('/departments', array('as' => 'admin.departments', 'uses' => 'Admin\DepartmentsController@index'));
Route::get('/departments/getdepartmentsData', array('as' => 'admin.departmentsData', 'uses' => 'Admin\DepartmentsController@departmentsData'));
Route::get('/departments/create', 'Admin\DepartmentsController@create')->name('admin.departments.create');
Route::post('/departments', 'Admin\DepartmentsController@store')->name('admin.departments.store');
Route::get('/departments/{id}/edit', 'Admin\DepartmentsController@edit')->name('admin.departments.edit');
Route::patch('/departments/{id}/edit', array('as' => 'admin.departments.update', 'uses' => 'Admin\DepartmentsController@update'));
Route::get('/departments/{id}', 'Admin\DepartmentsController@show');
Route::delete('/departments/{id}', ['as' => 'admin.departments.delete', 'uses' => 'Admin\DepartmentsController@destroy']);



//--Contents --//

Route::get('/contents/create', ['as' => 'admin.contents.create', 'uses' => 'Admin\ContentController@create']);
Route::post('/contents', ['as' => 'admin.contents.store', 'uses' => 'Admin\ContentController@store']);
Route::get('/contents/{id}/edit', ['as' => 'admin.contents.edit', 'uses' => 'Admin\ContentController@edit']);
Route::patch('/contents/{id}/edit', ['as' => 'admin.contents.update', 'uses' => 'Admin\ContentController@update']);
Route::delete('/contents/{id}', ['as' => 'admin.contents.delete', 'uses' => 'Admin\ContentController@destroy']);

//--subcontent--//
Route::get('/contents/{contentId}/subcontent/create', ['as' => 'admin.contents.subcontent.create', 'uses' => 'Admin\SubContentController@create']);
Route::post('/contents/{contentId}/subcontent', ['as' => 'admin.contents.quizes.store', 'uses' => 'Admin\SubContentController@store']);
Route::get('/contents/{contentId}/subcontent/{id}/edit', ['as' => 'admin.contents.subcontent.edit', 'uses' => 'Admin\SubContentController@edit']);
Route::patch('/contents/{contentId}/subcontent/{id}/edit', ['as' => 'admin.contents.subcontent.update', 'uses' => 'Admin\SubContentController@update']);
Route::delete('/contents/{contentId}/subcontent', ['as' => 'admin.contents.subcontent.delete', 'uses' => 'Admin\SubContentController@destroy']);



//--quizes --//
Route::get('/contents/{contentId}/quizes/create', ['as' => 'admin.contents.quizes.create', 'uses' => 'Admin\QuizesController@create']);
Route::post('/contents/{contentId}/quizes', ['as' => 'admin.contents.quizes.store', 'uses' => 'Admin\QuizesController@store']);
Route::get('/contents/{contentId}/quizes/{id}/edit', ['as' => 'admin.contents.quizes.edit', 'uses' => 'Admin\QuizesController@edit']);
Route::patch('/contents/{contentId}/quizes/{id}/edit', ['as' => 'admin.contents.quizes.update', 'uses' => 'Admin\QuizesController@update']);
Route::delete('/contents/{contentId}/quizes', ['as' => 'admin.contents.quizes.delete', 'uses' => 'Admin\QuizesController@destroy']);
Route::get('/quizes/{id}/{quiz_name}', ['as' => 'admin.quiz.show', 'uses' => 'Admin\QuizesController@show']);
Route::get('/contents/{contentId}/quizes/{id}/getquestionsData', array('as' => 'admin.contents.quizes.questionsData', 'uses' => 'Admin\QuizesController@questionsData'));


//--attempt quiz--//

Route::get('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'admin.quiz.attemptquiz', 'uses' => 'Admin\AttemptQuizController@create']);

Route::post('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'admin.quiz.attemptquiz.store', 'uses' => 'Admin\AttemptQuizController@store']);

Route::get('/quiz/{quizId}/{quiz_name}/attemptquiz/{id}/result', ['as' => 'admin.quiz.attemptquiz.result', 'uses' => 'Admin\AttemptQuizController@edit']);



//--questions --//
Route::get('/questions/{type}/create', ['as' => 'admin.questions.create', 'uses' => 'Admin\QuestionsController@create']);
Route::post('/questions/{type}', ['as' => 'admin.questions.type.store', 'uses' => 'Admin\QuestionsController@store']);
Route::get('/questions/getquestionsData', array('as' => 'admin.questionsData', 'uses' => 'Admin\QuestionsController@questionsData'));
Route::get('/questions/{id}/edit', 'Admin\QuestionsController@edit')->name('admin.questions.edit');
Route::patch('/questions/{id}/update', array('as' => 'admin.questions.update', 'uses' => 'Admin\QuestionsController@update'));
Route::delete('/questions/{id}', ['as' => 'admin.questions.delete', 'uses' => 'Admin\QuestionsController@destroy']);

//--Lectures--//
Route::get('/contents/{contentId}/lectures/create', ['as' => 'admin.contents.lectures.create', 'uses' => 'Admin\LectureController@create']);
Route::post('/contents/{contentId}/lectures', ['as' => 'admin.contents.lectures.store', 'uses' => 'Admin\LectureController@store']);
Route::get('/contents/{contentId}/lectures/{id}/edit', ['as' => 'admin.contents.lectures.edit', 'uses' => 'Admin\LectureController@edit']);
Route::patch('/contents/{contentId}/lectures/{id}/edit', ['as' => 'admin.contents.lectures.update', 'uses' => 'Admin\LectureController@update']);
Route::delete('/lectures/{id}', ['as' => 'admin.lectures.delete', 'uses' => 'Admin\LectureController@destroy']);
Route::get('/lectures/{id}/{lecture_name}', ['as' => 'admin.lectures.show', 'uses' => 'Admin\LectureController@show']);

//--assignments--//
Route::get('/contents/{contentId}/assignments/create', ['as' => 'admin.contents.assignments.create', 'uses' => 'Admin\AssignmentController@create']);
Route::patch('/contents/{contentId}/assignments/{id}/edit', ['as' => 'admin.contents.assignments.update', 'uses' => 'Admin\AssignmentController@update']);
Route::post('/contents/{contentId}/assignments', ['as' => 'admin.contents.assignments.store', 'uses' => 'Admin\AssignmentController@store']);
Route::get('/contents/{contentId}/assignments/{id}/edit', ['as' => 'admin.contents.assignments.edit', 'uses' => 'Admin\AssignmentController@edit']);

Route::delete('/assignments/{id}', ['as' => 'admin.assignments.delete', 'uses' => 'Admin\AssignmentController@destroy']);
Route::get('/contents/{contentId}/assignments/{AssignmentId}/{assignment_title}', ['as' => 'admin.assignments.show', 'uses' => 'Admin\AssignmentController@show']);


//--assignmentsubmission grade--//
Route::get('/contents/{contentId}/assignment/{id}/assignmentsubmission/getsubmissionData', array('as' => 'admin.submissionData', 'uses' => 'Admin\AssignmentController@submissionData'));
Route::get('/contents/{contentId}/assignment/{assignmentId}/assignmentsubmission/{id}', array('as' => 'admin.contents.assignment.assignmentsubmission.view', 'uses' => 'Admin\AssignmentController@view'));
Route::PATCH('/contents/{contentId}/assignment/{assignmentId}/assignmentsubmission/{id}', array('as' => 'admin.contents.assignment.assignmentsubmission.update', 'uses' => 'Admin\AssignmentSubmissionController@update'));



Route::delete('/assignments/{id}', ['as' => 'admin.assignments.delete', 'uses' => 'Admin\AssignmentController@destroy']);
Route::get('/contents/{contentId}/assignment/{assignmentId}/{assignment_title}', ['as' => 'admin.assignments.show', 'uses' => 'Admin\AssignmentController@show']);


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
Route::get('/courses', array('as' => 'student.courses', 'uses' => 'student\CoursesController@index', 'middleware'=>'roles',
	'roles'=>['Student']));
Route::get('/courses/getcoursesData', array('as' => 'student.coursesData', 'uses' => 'student\CoursesController@coursesData', 'middleware'=>'roles',
	'roles'=>['Student']));
Route::get('/courses/{id}', array('as' => 'student.courses.show', 'uses' =>  'student\CoursesController@show', 'middleware'=>'roles',
	'roles'=>['Student']));
Route::match(['get', 'post'],'/courses/{id}/enroll', array('as' => 'student.courses.enroll', 'uses' => 'student\CoursesController@enroll', 'middleware'=>'roles',
	'roles'=>['Student']));

//Route::get('programmes/{id}/{course_name}', ['as' => 'admin.courses.show', 'uses' => 'Admin\CoursesController@show']);


//--Lectures--//
Route::get('/contents/{contentId}/lectures/{id}/{lecture_name}', ['as' => 'student.contents.lectures.show', 'uses' => 'student\LectureController@show', 'middleware'=>'roles',
	'roles'=>['Student']]);

//--Assignment--//
Route::get('/contents/{contentId}/assignments/{AssignmentId}', ['as' => 'student.contents.assignments.submission.show', 'uses' => 'student\AssignmentSubmissionController@show', 'middleware'=>'roles',
	'roles'=>['Student']]);

Route::get('/contents/{contentId}/assignments/{AssignmentId}/assignmentsubmission/create', ['as' => 'student.contents.assignments.submission.create', 'uses' => 'student\AssignmentSubmissionController@create', 'middleware'=>'roles',
	'roles'=>['Student']]);

Route::post('/contents/{contentId}/assignments/{AssignmentId}/assignmentsubmission', ['as' => 'student.contents.assignments.submission.store', 'uses' => 'student\AssignmentSubmissionController@store', 'middleware'=>'roles',
	'roles'=>['Student']]);

Route::get('/contents/{contentId}/assignments/{AssignmentId}/assignmentsubmission/{id}/edit', ['as' => 'student.contents.assignments.submission.edit', 'uses' => 'student\AssignmentSubmissionController@edit', 'middleware'=>'roles',
	'roles'=>['Student']]);


Route::patch('/contents/{contentId}/assignments/{AssignmentId}/assignmentsubmission/{id}', ['as' => 'student.contents.assignments.submission.update', 'uses' => 'student\AssignmentSubmissionController@update', 'middleware'=>'roles',
	'roles'=>['Student']]);

//--Attempt Quiz--//
Route::get('/quizes/{id}/{quiz_name}', ['as' => 'student.quiz.show', 'uses' => 'student\QuizesController@show']);
Route::get('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'student.quiz.attemptquiz', 'uses' => 'student\AttemptQuizController@create', 'middleware'=>'roles',
	'roles'=>['Student']]);

Route::post('/quiz/{id}/{quiz_name}/attemptquiz', ['as' => 'student.quiz.attemptquiz.store', 'uses' => 'student\AttemptQuizController@store', 'middleware'=>'roles',
	'roles'=>['Student']]);

Route::get('/quiz/{quizId}/{quiz_name}/attemptquiz/{id}/result', ['as' => 'student.quiz.attemptquiz.result', 'uses' => 'student\AttemptQuizController@edit', 'middleware'=>'roles',
	'roles'=>['Student']]);


});




