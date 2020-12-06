<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request Request
     * @param String  $stream  Streamer id
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $stream)
    {
        return view('stream', ['stream' => strtolower($stream)]);
    }
}
