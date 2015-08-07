<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Api\Streams;
use App\Api\Games;
use App\Api\Search;
use App\Transformers\GameTransformer;
use App\Transformers\StreamTransformer;
use App\Transformers\Transformer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Transformer
     * @var Transformer
     */
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
            $result = $this->transformer->transform($list->streams, new StreamTransformer);

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

    /**
     * Returns a transformed JSON list of the followed streams.
     *
     * @param  integer  $limit
     * @param  integer  $offset
     * @param  string  $identifier
     * @param  Streams $streams
     * @param  Request $request
     * @return response
     */
    public function followed($limit, $offset, $identifier, Streams $streams, Request $request)
    {
        if (! \Cache::has($identifier)) {
            throw new Exception("Invalid identifier.", 1);
        }

        $token = \Cache::get($identifier);

        $list = $streams->followed($token, $limit, $offset);
        $result = $this->transformer->transform($list->streams, new StreamTransformer);

        return response()->json($result);
    }

    /**
     * Returns a transformed JSON list of the searched streams
     *
     * @param  string $query
     * @param  Search $search
     * @return Reponse
     */
    public function search($query = "", Search $search)
    {
        if ($query == "") {
            return response()->json();
        }

        if (! \Cache::has("search_{$query}")) {
            $list = $search->streams($query);
            $result = $this->transformer->transform($list->streams, new StreamTransformer);

            \Cache::put("search_{$query}", $result, 1);
        }

        return response()->json(\Cache::get("search_{$query}"));
    }
}
