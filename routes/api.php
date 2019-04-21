<?php

use Illuminate\Http\Request;

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function() {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('logout', 'AuthController@logout');
});

Route::group([
    'prefix' => 'all-galleries'
], function() {
    Route::get('/', 'GalleriesController@index');
    Route::get('{id}', 'UserGalleriesController@index');
});

Route::group([
    'prefix' => 'galleries'
], function() {
    Route::get('{id}', 'GalleriesController@show');
    Route::post('/', 'GalleriesController@store');
    Route::put('{id}', 'GalleriesController@update');
    Route::delete('{id}', 'GalleriesController@destroy');
    Route::post('{id}/comments', 'CommentsController@store');
});

Route::delete('/comments/{id}', 'CommentsController@destroy');
