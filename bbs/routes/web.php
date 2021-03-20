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
Route::get('/', 'ArticleController@index')->name('index');
Route::resource('/articles', 'ArticleController')->except(['index']);
Route::get('/articles/solve/{article}/{isEnglishToJapanese}', 'ArticleController@solve')->name('articles.solve');
Route::post('/articles/result', 'ArticleController@result')->name('articles.result');