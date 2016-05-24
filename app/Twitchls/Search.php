<?php

namespace Twitchls;

use Twitch\Search as TwitchSearch;
use Twitchls\Api;
use Twitchls\Transformers\StreamTransformer;

class Search
{
    /**
     * Twitchls Api
     * @var Twitchls\Api
     */
    protected $api;

    public function __construct(Api $api, TwitchSearch $search)
    {
        $this->api = $api;
        $this->api->setResource($search);
    }

    /**
     * Retrieves a list of searched streams by query.
     *
     * @param string  $query
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function streams($query, $limit, $offset)
    {
        return $this->api->cachedApiCall(func_get_args(), 'streams', new StreamTransformer);
    }

}
