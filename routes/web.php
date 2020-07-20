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


Auth::routes();

Route::get('/', function () {
	return view('auth.login');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/getCoursesWithMoreStudents','HomeController@getCoursesWithMoreStudents')->name('getCoursesWithMoreStudents');
	Route::get('/estudiante','EstudianteController@index')->name('estudiante');
	Route::get('/getEstudiante','EstudianteController@getEstudiante')->name('getEstudiante');
	Route::post('/registrarEstudiante','EstudianteController@registrarEstudiante')->name('registrarEstudiante');
	Route::get('/curso','CursoController@index')->name('curso');
	Route::get('/getHorarios','HorarioController@getHorarios')->name('getHorarios');
	Route::post('/registrarCurso','CursoController@registrarCurso')->name('registrarCurso');
	Route::get('/asigCurso','AsigCursoController@index')->name('asigCurso');
	Route::get('/getCursos','AsigCursoController@getCursos')->name('getCursos');
	Route::post('/asigCursoEstudiante','AsigCursoController@asigCursoEstudiante')->name('asigCursoEstudiante');
	Route::get('/viewStudent','EstudianteController@viewStudent')->name('viewStudent');
	Route::get('/viewCourses','CursoController@viewCourses')->name('viewCourses');
	Route::delete('/deleteCurso/{id}','CursoController@deleteCurso')->name('deleteCurso');
	Route::put('/actualizarCurso','CursoController@actualizarCurso')->name('actualizarCurso');
	Route::get('/viewDetailedCourse/{id}','CursoController@viewDetailedCourse')->name('viewDetailedCourse');
	Route::get('/viewDetailedStudent/{id}','EstudianteController@viewDetailedStudent')->name('viewDetailedStudent');
	Route::post('/actualizarEstudiante','EstudianteController@actualizarEstudiante')->name('actualizarEstudiante');
	Route::delete('/deleteEstudiante/{id}','EstudianteController@deleteEstudiante')->name('deleteEstudiante');
	Route::put('/actualizarEstudiante','EstudianteController@actualizarEstudiante')->name('actualizarEstudiante');
});

