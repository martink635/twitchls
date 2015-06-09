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
        if (! \Cache::has('streams')) {
            \Cache::put('streams', $this->streams->all(), 1);
        }

        $streams = \Cache::get('streams');

        return view('index', ['streams' => $streams]);
    }

    /**
     * Retrieves 1 stream and displays it with Twitch chat
     *
     * @param  string
     * @return Response
     */
    public function show($stream)
    {
        $stream = $this->streams->get($stream);

        if ($stream === null) {
            return redirect('/');
        }

        return view('stream', ['stream' => $stream]);
    }
}
