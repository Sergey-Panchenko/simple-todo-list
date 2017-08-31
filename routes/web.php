<?php

Auth::routes();
Route::get('/', 'IndexController@index')->name('home');

Route::post('/createProject','ProjectController@create');
Route::post('/updateProject','ProjectController@update');
Route::post('/deleteProject','ProjectController@delete');

Route::post('/createTask','TaskController@create');
Route::post('/updateTask','TaskController@update');
Route::post('/deleteTask','TaskController@delete');
Route::post('/sortTask','TaskController@sort');
