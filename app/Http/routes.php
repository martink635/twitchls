<?php

$app->get('/', 'App\Http\Controllers\StreamsController@index');

$app->get('/about', function() {
    return view('about');
});

$app->get('/api/v1/games/{limit}', 'App\Http\Controllers\ApiController@games');
$app->get('/api/v1/streams/{limit}/{offset}', 'App\Http\Controllers\ApiController@all');
$app->get('/api/v1/streams/{limit}/{offset}/{game}', 'App\Http\Controllers\ApiController@all');
$app->get('/api/v1/followed/{limit}/{offset}/{identifier}', 'App\Http\Controllers\ApiController@followed');
$app->get('/api/v1/search/', 'App\Http\Controllers\ApiController@search');
$app->get('/api/v1/search/{query}', 'App\Http\Controllers\ApiController@search');

$app->get('/login', 'App\Http\Controllers\AuthController@login');
$app->get('/logout', 'App\Http\Controllers\AuthController@logout');
$app->get('/callback', 'App\Http\Controllers\AuthController@callback');

if (getenv('APP_DEBUG') == false) {
    $app->get('/flush', function() {
        \Session::flush();
        \Cache::flush();
    });
}

$app->get('/{stream}', 'App\Http\Controllers\StreamsController@show');
