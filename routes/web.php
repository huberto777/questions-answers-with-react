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

Route::resource('questions', 'QuestionsController');

// Route::post('/questions/{question}/answer','AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController')->except(['show', 'edit']);

// single action controller (metoda w kontrolerze __invoke()) ACCEPT: answers
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

// FAVORITES: questions
Route::post('/questions/{question}/favorites', 'FavoritesController@store');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy');

// VOTE: questions, answers
Route::post('/vote/{votable_id}/{votable_type}', 'VoteController@store');
Route::delete('/unvote/{votable_id}/{votable_type}', 'VoteController@destroy');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
