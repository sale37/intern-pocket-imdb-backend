<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::apiResource('movies', 'Api\MovieController');
Route::patch('/movies/updateLikeDislike/{movie}', 'Api\MovieController@updateLikeDislike');
Route::get('/movies/{movie}/comments', 'Api\MovieController@getCommentsForMovie');

Route::get('/genres', 'GenreController@index');

Route::apiResource('comments', 'CommentController');

Route::apiResource('watchlists', 'WatchlistController');
Route::delete('watchlists/{watchlist}/movies/{movie}', 'WatchlistController@destroyMovieFromWatchlist');
Route::patch('/movies/{movie}/watched', 'Api\MovieController@markAsWatchedUnwatched');