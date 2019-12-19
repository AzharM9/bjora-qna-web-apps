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

Route::get('/', function(){
    return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');
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
    Route::post('/create', 'MessageController@store');
    Route::post('/delete/{id}', 'MessageController@destroy');
    Route::get('/inbox', 'MessageController@index');
});

/*.Akses memerlukan Login terlebih dahulu.*/
// <<<<<<< HEAD
// Route::get('/question/{id}', 'QuestionController@show')->name('question.show');
// // Route::resource('inboxes', 'MessageController')->middleware('auth');
// // Route::resource('answer', 'AnswerController')->middleware('auth');
// Route::get('/profile/{id}', 'ProfileController@index')->middleware('auth')->name('profile.index');
// =======
Route::resource('answer', 'AnswerController')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');


//route admin
Route::group([
    'prefix' => 'admin',
], function () {
    // Route::get('/newUser', 'AdminController@createUser')->middleware('CheckRole');

    Route::get('/topic', 'TopicController@index')->middleware('CheckRole')->name('topic.index');
    Route::post('/topic/create', 'TopicController@store')->middleware('CheckRole');
    Route::get('/topic/edit/{id}','TopicController@edit')->middleware('CheckRole');
    Route::post('/topic/edit/{id}','TopicController@update')->middleware('CheckRole');
    Route::post('/topic/destroy', 'TopicController@destroy')->middleware('CheckRole');

    Route::get('/user','UserController@index')->middleware('CheckRole')->name('user.index');
    Route::get('/user/create','UserController@create')->middleware('CheckRole')->name('user.create');
    Route::post('/user','UserController@store')->middleware('CheckRole')->name('user.store');
    Route::get('/user/edit/{id}', 'UserController@edit')->middleware('CheckRole')->name('user.edit');
    Route::post('/user/edit/{id}', 'UserController@update')->middleware('CheckRole')->name('user.update');
    Route::post('/topic/destroy', 'UserController@destroy')->middleware('CheckRole')->name('user.destroy');

});



