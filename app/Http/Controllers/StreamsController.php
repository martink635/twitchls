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
     * Retrieves 1 stream and displays it with Twitch chat.
     * Not caching on purpose.
     *
     * @param  string
     * @return Response
     */
    public function show($stream)
    {
        $stream = $this->streams->get($stream);

        if (! isset($stream->stream)) {
            return redirect('/');
        }

        return view('stream', ['stream' => $stream->stream]);
    }
}
