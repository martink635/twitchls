<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twitchls\Streams;

class StreamController extends Controller
{
    /**
     * @var Twitchls\Streams
     */
    protected $streams;

    public function __construct(Streams $streams)
    {
        $this->streams = $streams;
    }

    /**
     * Return a JSON with a list of streams.
     *
     * @param  Request  $request
     * @return Response
     */
    public function all(Request $request)
    {
        $game = $request->header('game');
        $limit = $request->header('limit');
        $offset = $request->header('offset');

        return response()->json($this->streams->all($game, $limit, $offset));
    }

    /**
     * Return a JSON with a list of streams.
     *
     * @param  string   $name
     * @return Response
     */
    public function get($name)
    {
        return response()->json($this->streams->get($name));
    }

    /**
     * Returns a transformed JSON list of the followed streams.
     *
     * @param  Request  $request
     * @return response
     */
    public function followed(Request $request)
    {
        $identifier = $request->header('identifier');

        if (! \Cache::has($identifier)) {
            throw new \Exception("Invalid identifier.");
        }

        $token = \Cache::get($identifier);
        $limit = $request->header('limit');
        $offset = $request->header('offset');

        return response()->json($this->streams->followed($token, $limit, $offset));
    }
}
