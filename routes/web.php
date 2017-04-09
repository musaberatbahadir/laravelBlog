<?php

Route::get('/', 'PostsController@index');

Route::post('/posts', 'PostsController@store');

Route::get('/posts/create', 'PostsController@create');

Route::get('/posts/{post}', 'PostsController@show');
Route::delete('/posts/{post}', 'PostsController@deletepost');
Route::put('/posts/{post}', 'PostsController@updatePost');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::get('/posts/{post}/update', 'PostsController@showUpdatePage');

Route::get('/search', 'PostsController@search');