<?php

$app->get('/', 'App\Http\Controllers\StreamsController@index');

$app->get('/about', function() {
    return view('about');
});

$app->get('/{stream}', 'App\Http\Controllers\StreamsController@show');
