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

// User Routes

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/courses/{slug}', 'CoursesController@index')->name('courses');
Route::get('/courses/{slug}/quizzes/{name}', 'QuizController@index')->name('quiz');
Route::post('/courses/{slug}/quizzes/{name}', 'QuizController@submit');
Route::get('/search', 'SearchController@index');

// Admin Routes

Route::group(['middleware' => ['auth', 'admin'] ], function () {

	Route::get('admin', function() {
		return redirect('admin/dashboard');
	});

	Route::get('admin/dashboard', 'Admin\HomeController@index')->name('home');

	Route::resource('admin/admins', 'Admin\AdminController', ['except' => ['show']]);

	Route::resource('admin/users', 'Admin\UserController', ['except' => ['show']]);
	Route::resource('admin/tracks', 'Admin\TrackController');
	Route::resource('admin/track.courses', 'Admin\TrackCourseController');
	Route::resource('admin/courses', 'Admin\CourseController');
	Route::resource('admin/courses.videos', 'Admin\courseVideoController');
	Route::resource('admin/courses.quizzes', 'Admin\CourseQuizController');
	Route::resource('admin/videos', 'Admin\VideoController');
	Route::resource('admin/quizzes', 'Admin\QuizzeController');
	Route::resource('admin/quizzes.questions', 'Admin\QuizQuestionController');
	Route::resource('admin/questions', 'Admin\QuestionController');

	Route::get('admin/profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);

	Route::put('admin/profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);

	Route::put('admin/profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
});

