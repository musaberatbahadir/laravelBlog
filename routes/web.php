<?php

Route::get('/', 'PostsController@index');

Route::get('/posts/create', 'PostsController@create');

Route::post('/posts', 'PostsController@store');
Route::get('/posts/nigga', 'PostsController@nigga');

Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::delete('/posts/{post}', 'PostsController@deletepost');

//Route::get('/posts/{post}', 'PostsController@show');

