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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/my-question', 'QuestionController@show');
Route::get('/question', 'QuestionController@create')->name('question');
Route::post('/question', 'QuestionController@store')->name('question');
Route::get('/question/edit/{id}', 'QuestionController@edit')->name('edit-question')->middleware('guard.edit.question');
Route::post('/question/edit/{id}', 'QuestionController@update');
Route::post('/question/destroy', 'QuestionController@destroy');
