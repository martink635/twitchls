<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Api\Streams;
use App\Api\Games;
use App\Transformers\GameTransformer;
use App\Transformers\StreamTransformer;
use App\Transformers\Transformer;

class ApiController extends Controller
{
    protected $streams;
    protected $transformer;

    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Return a JSON with a list of streams.
     *
     * @param  integer
     * @param  integer
     * @param  string
     * @param  Streams
     * @return Response
     */
    public function all($limit, $offset, $game = "", Streams $streams)
    {
        // Generate a key based on the parameters
        $key = "streams_{$limit}_{$offset}_{$game}";

        // If key doesn't exist, fetch and transform streams
        if (! \Cache::has($key)) {
            $list = $streams->all(urldecode($game), $limit, $offset);
            $result = $this->transformer->transform($list, new StreamTransformer);

            \Cache::put($key, $result, 1);
        }

        return response()->json(\Cache::get($key));
    }

    /**
     * Returns a JSON list of games
     *
     * @param  integer
     * @param  Games
     * @return Response
     */
    public function games($limit, Games $games)
    {
        if (! \Cache::has("games")) {
            $list = $this->transformer->transform($games->top($limit), new GameTransformer);

            \Cache::put("games", $list, 1);
        }

        return response()->json(\Cache::get("games"));
    }
}
