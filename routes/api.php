<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Patient API Routes 
//Route::Resource('/patient','PatientsController') ; 
Route::get('/patient','PatientsController@index') ; 
Route::get('/patient/{name}','PatientsController@show') ; 
Route::post('/patient','PatientsController@store') ; 
Route::put('/patient/{id}','PatientsController@update') ; 
Route::delete('/patient/{id}','PatientsController@destroy') ; 
Route::get('/patient/login/{username}/{password}','PatientsController@login') ; 

// Doctor API Routes
Route::get('/doctor','DoctorsController@index') ; 
Route::get('/doctor/name/{name}','DoctorsController@showByName') ; 
Route::get('/doctor/specialty/{specialty}','DoctorsController@showBySpecialty') ;
Route::get('/doctor/name/{name}/specialty/{specialty}','DoctorsController@showByNameNdSpecialty') ; 
Route::post('/doctor','DoctorsController@store') ; 
Route::put('/doctor/{id}','DoctorsController@update') ; 
Route::delete('/doctor/{id}','DoctorsController@destroy') ; 
Route::get('/doctor/login/{username}/{password}','DoctorsController@login') ; 


// Consultation API Routes
Route::get('/consultation','ConsultationsController@index') ; 
Route::get('/consultation/byPatient/{id}','ConsultationsController@showByPatient');
Route::get('/consultation/byDoctor/{id}','ConsultationsController@showByDoctor');
Route::post('/consultation','ConsultationsController@store') ; 
Route::put('/consultation/{id}','ConsultationsController@update') ; 
Route::delete('/consultation/{id}','ConsultationsController@destroy') ; 

// TimeTable API Routes
Route::get('/timeTable/{doctor_id}','TimeTablesController@show') ; 
Route::get('/timeTable/free/{doctor_id}','TimeTablesController@getFreeTime') ;
Route::post('/timeTable','TimeTablesController@store')  ; 
Route::delete('/timeTable/{doctor_id}','TimeTablesController@destroy') ; 
