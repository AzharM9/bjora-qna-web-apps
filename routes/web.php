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


Route::group(['prefix' => 'question'],function(){
    Route::get('/', 'QuestionController@create')->name('question');
    Route::post('/', 'QuestionController@store')->name('question');
    Route::get('/edit/{id}', 'QuestionController@edit')->name('edit-question')->middleware('guard.edit.question');
    Route::post('/edit/{id}', 'QuestionController@update');
    Route::post('/destroy', 'QuestionController@destroy');
    Route::get('/{id}', 'AnswerController@show')->name('answer');
});

Route::group(['prefix' => 'message'], function(){
    //route message
});

/*.Akses memerlukan Login terlebih dahulu.*/
Route::resource('answer', 'AnswerController')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function () {
    Route::get('/newUser', 'AdminController@createUser')->middleware('CheckRole');
});



