<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Api\Streams;

class StreamsController extends Controller
{
    protected $streams;

    public function __construct(Streams $streams)
    {
        $this->streams = $streams;
    }

    /**
     * Show the list of all online streams.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Retrieves 1 stream and displays it with Twitch chat
     * @TODO Transform data before submitting into cache.
     *
     * @param  string
     * @return Response
     */
    public function show($stream)
    {
        if (! \Cache::has($stream)) {
            \Cache::put($stream, $this->streams->get($stream), 1);
        }

        if (\Cache::get($stream) === null) {
            return redirect('/');
        }

        return view('stream', ['stream' => \Cache::get($stream)]);
    }
}
