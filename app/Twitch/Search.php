<?php

namespace Twitch;

use Twitch\Api;

class Search
{
    /**
     * Api endpoint
     * @var string
     */
    protected $endpoint;

    /**
     * Twitch Object
     * @var Twitch
     */
    protected $twitch;

    public function __construct(Api $twitch)
    {
        $this->endpoint = "search/streams";
        $this->twitch = $twitch;
    }

    /**
     * Returns a list of streams using the search query, sorted
     * by number of current viewers on Twitch, most popular first.
     *
     * @param  string  $query
     * @param  integer $limit
     * @param  integer $offset
     * @return object
     */
    public function streams($query, $limit = 25, $offset = 0)
    {
        $options = [
            'query' => [
                'query'  => $query,
                'limit'  => $limit,
                'offset' => $offset,
            ]
        ];

        return $this->twitch->options($options)->get($this->endpoint)->streams;
    }
}
