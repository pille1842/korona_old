<?php 
/*
 * Korona - A free community management system for German-language fraternities
 * Copyright (C) 2016 Eric Haberstroh <eric@erixpage.de>
 *
 * This file is part of Korona.
 *
 * Korona is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Korona is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Korona.  If not, see <http://www.gnu.org/licenses/>.
 */

use Vsch\TranslationManager\Translator;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/profile', 'UserController@getMyProfile');
Route::get('/u/{handle}', 'UserController@getUserProfile');
Route::resource('/post', 'PostController');
Route::resource('/comment', 'CommentController');

Route::post('/api/like', 'ReactionController@postLike');
Route::post('/api/dislike', 'ReactionController@postDislike');

/*\Route::group(['middleware' => 'auth', 'prefix' => 'translations'], function () {
    Translator::routes();
});*/
