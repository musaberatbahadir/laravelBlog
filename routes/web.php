<?php

Route::get('/', 'PostsController@index');

Route::post('/posts', 'PostsController@store');

Route::get('/posts/create', 'PostsController@create');

Route::get('/posts/{post}', 'PostsController@show');
Route::delete('/posts/{post}', 'PostsController@deletePost');
Route::put('/posts/{post}', 'PostsController@updatePost');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::get('/posts/{post}/update', 'PostsController@showUpdatePage');

Route::get('/search', 'PostsController@search');

Route::get('/api/search', 'ApiController@search');
Route::get('/api/posts', 'ApiController@allPosts');
Route::get('/api/post/{post}', 'ApiController@specificPost');