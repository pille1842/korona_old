<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/profile', 'UserController@getMyProfile');
Route::get('/u/{handle}', 'UserController@getUserProfile');
Route::resource('/post', 'PostController');

Route::post('/api/like', 'ReactionController@postLike');
Route::post('/api/dislike', 'ReactionController@postDislike');
Route::get('/api/comments', 'ReactionController@getComments');
Route::post('/api/comment', 'ReactionController@postComment');