<?php

Route::group(['middleware' => ['web']], function () {

    // Api v1 routes
    Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\v1'], function () {
        Route::get('games', 'GameController@top');
        Route::get('streams', 'StreamController@all');
        Route::get('streams/{name}', 'StreamController@get');
        Route::get('followed', 'StreamController@followed');
        Route::get('search', 'SearchController@streams');
    });

    // Authentication routes
    Route::get('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::get('callback', 'AuthController@callback');

    // Clear cache, used for debugging.
    if (getenv('APP_ENV') !== 'production') {
        Route::get('flush', function () {
            \Session::flush();
            \Cache::flush();
        });
    }

    // Captures Vue.js routes
    Route::get('/{vue_capture?}', function () {
        return view('index');
    })->where('vue_capture', '[\/\w\.-]*');
});
