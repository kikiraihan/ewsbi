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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');




//User
Route::group(['prefix' => 'user'], function() {
    Route::get('/', 'UserController@index')->name('user');
    Route::get('/surveyor', 'UserController@tampilSurveyorInstansi')->name('user.surveyor');
    // Route::get('/search', 'UserController@search')->name('user.search');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::get('/edit/biodata', 'UserController@editBiodata')->name('user.edit.biodata');
    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::put('/update/biodata/{id}', 'UserController@updateBiodata')->name('user.update.biodata');
    Route::put('/update/{id}', 'UserController@update')->name('user.update');
    Route::put('/update-bySupervisor/{id}', 'UserController@updateBySupervisor')->name('user.updateBySupervisor');
    // Route::get('/{id}', 'UserController@show')->name('user.show');
    Route::put('/', 'UserController@store')->name('user.store');
    Route::put('/surveyor', 'UserController@storeSurveyor')->name('user.surveyor.store');
    Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy');
});

//komoditas
Route::group(['prefix' => 'komoditas'], function() {
    Route::get('/', 'KomoditasController@index')->name('komoditas');
    // Route::get('/search', 'KomoditasController@search')->name('komoditas.search');
    Route::get('/create', 'KomoditasController@create')->name('komoditas.create');
    Route::get('/edit/{id}', 'KomoditasController@edit')->name('komoditas.edit');
    Route::put('/update/{id}', 'KomoditasController@update')->name('komoditas.update');
    // Route::get('/{id}', 'KomoditasController@show')->name('komoditas.show');
    Route::put('/', 'KomoditasController@store')->name('komoditas.store');
    Route::delete('/delete/{id}', 'KomoditasController@destroy')->name('komoditas.destroy');
});

//Lokasi
Route::group(['prefix' => 'lokasi'], function() {
    Route::get('/', 'LokasiController@index')->name('lokasi');
    // Route::get('/search', 'LokasiController@search')->name('lokasi.search');
    Route::get('/create', 'LokasiController@create')->name('lokasi.create');
    Route::get('/edit/{id}', 'LokasiController@edit')->name('lokasi.edit');
    Route::put('/update/{id}', 'LokasiController@update')->name('lokasi.update');
    // Route::get('/{id}', 'LokasiController@show')->name('lokasi.show');
    Route::put('/', 'LokasiController@store')->name('lokasi.store');
    Route::delete('/delete/{id}', 'LokasiController@destroy')->name('lokasi.destroy');
});

//Instansi
Route::group(['prefix' => 'instansi'], function() {
    Route::get('/', 'InstansiController@index')->name('instansi');
    // Route::get('/search', 'InstansiController@search')->name('instansi.search');
    Route::get('/create', 'InstansiController@create')->name('instansi.create');
    Route::get('/edit/{id}', 'InstansiController@edit')->name('instansi.edit');
    Route::put('/update/{id}', 'InstansiController@update')->name('instansi.update');
    // Route::get('/{id}', 'InstansiController@show')->name('instansi.show');
    Route::put('/', 'InstansiController@store')->name('instansi.store');
    Route::delete('/delete/{id}', 'InstansiController@destroy')->name('instansi.destroy');
});


//tugas survey
Route::group(['prefix' => 'tugas_survey'], function() {
    Route::get('/', 'TugasSurveyController@index')->name('tugas_survey');
    Route::get('/instansi', 'TugasSurveyController@tugasInstansi')->name('tugas_survey.instansi');

    // Route::get('/search', 'TugasSurveyController@search')->name('tugas_survey.search');
    Route::get('/create', 'TugasSurveyController@create')->name('tugas_survey.create');
    Route::get('/edit/{id}', 'TugasSurveyController@edit')->name('tugas_survey.edit');
    Route::put('/update/{id}', 'TugasSurveyController@update')->name('tugas_survey.update');
    // Route::get('/{id}', 'TugasSurveyController@show')->name('tugas_survey.show');
    Route::put('/', 'TugasSurveyController@store')->name('tugas_survey.store');

    Route::delete('/delete/{id}', 'TugasSurveyController@destroy')->name('tugas_survey.destroy');
});



//survey
Route::group(['prefix' => 'survey'], function() {
    Route::get('/', 'SurveyController@index')->name('survey');

    Route::get('/aproval', 'SurveyController@aproval')->name('survey.aproval');
    Route::get('/kosongkan', 'SurveyController@kosongkan')->name('survey.kosongkan');
    Route::get('/unaprove/{id}', 'SurveyController@unaprove')->name('survey.unaprove');
    Route::get('/aprove/{id}', 'SurveyController@aprove')->name('survey.aprove');

    Route::get('/mylist', 'SurveyController@mylist')->name('survey.mylist');

    Route::get('/chart', 'SurveyController@surveyChart')->name('survey-chart');
    // Route::get('/search', 'SurveyController@search')->name('survey.search');
    Route::get('/create', 'SurveyController@create')->name('survey.create');
    Route::get('/edit/{id}', 'SurveyController@edit')->name('survey.edit');
    Route::put('/update/{id}', 'SurveyController@update')->name('survey.update');
    // Route::get('/{id}', 'SurveyController@show')->name('survey.show');
    Route::put('/', 'SurveyController@store')->name('survey.store');
    Route::delete('/delete/{id}', 'SurveyController@destroy')->name('survey.destroy');
});

