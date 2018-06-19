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
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('patients','PatientsController');

Route::resource('hospitals','HospitalController');
Route::get('hospitals/{id}/delete','HospitalController@destroy');
Route::post('store_hospital_score','HospitalController@store_hospital_scores')->name('store_score');
Route::post('send_locations','HospitalController@send_locations');
Route::get('hospital_scores','HospitalController@list_hospitals_ccecsta_scores');
Route::get('ccecsta_results_column_graph','HospitalController@show_ccecsta_column_graph');
