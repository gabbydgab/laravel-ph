<?php

Auth::routes();

Route::view('/', 'welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::get('/articles/create', 'ArticlesController@create')->name('articles.create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::post('/articles', 'ArticlesController@store')->name('articles.store');
Route::patch('/articles/{article}', 'ArticlesController@update')->name('articles.update');
Route::delete('/articles/{article}', 'ArticlesController@destroy')->name('articles.destroy');

Route::post('/articles/{article}/likes', 'ArticleLikesController@store');
Route::delete('/articles/{article}/likes', 'ArticleLikesController@destroy');

Route::post('/media', 'MediaController@store')->name('media.store');
