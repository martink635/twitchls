<?php

$app->get('/', 'App\Http\Controllers\StreamsController@index');

$app->get('/about', function() {
    return view('about');
});

$app->get('/api/v1/games/{limit}', 'App\Http\Controllers\ApiController@games');
$app->get('/api/v1/streams/{limit}/{offset}', 'App\Http\Controllers\ApiController@all');
$app->get('/api/v1/streams/{limit}/{offset}/{game}', 'App\Http\Controllers\ApiController@all');

$app->get('/{stream}', 'App\Http\Controllers\StreamsController@show');
