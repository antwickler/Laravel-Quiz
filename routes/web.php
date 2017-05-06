<?php

Route::resource('students','Students\\StudentController');

Route::get('/students/searchSkill/{id}', 'Students\\StudentController@searchSkill');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Auth::routes();