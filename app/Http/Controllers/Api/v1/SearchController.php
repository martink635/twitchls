<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twitchls\Search;

class SearchController extends Controller
{
    /**
     * Returns a transformed JSON list of the searched streams.
     *
     * @param Request $request
     * @param Search  $search
     *
     * @return Response
     */
    public function streams(Request $request, Search $search)
    {
        $query = urlencode($request->header('query'));
        $limit = $request->header('limit');
        $offset = $request->header('offset');

        return response()->json($search->streams($query, $limit, $offset));
    }
}
