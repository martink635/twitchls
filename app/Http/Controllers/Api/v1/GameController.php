<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twitchls\Games;

class GameController extends Controller
{
    /**
     * Return a JSON with a list of games, ordered by views.
     *
     * @param Request $request
     * @param Games   $games
     *
     * @return Response
     */
    public function top(Request $request, Games $games)
    {
        $limit = $request->header('limit');
        $offset = $request->header('offset');

        return response()->json($games->top($limit, $offset));
    }
}
