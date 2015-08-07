<?php

namespace App\Api;

use App\Api\Twitch;

class Games
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

    public function __construct(Twitch $twitch)
    {
        $this->endpoint = "games";
        $this->twitch = $twitch;
    }

    /**
     * Returns a list of games objects sorted by number of
     * current viewers on Twitch, most popular first.
     *
     * @param  integer  $limit
     * @param  integer  $offset
     * @return object
     */
    public function top($limit = 10, $offset = 0)
    {
        $options = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ]
        ];

        return $this->twitch->options($options)->get("{$this->endpoint}/top")->top;
    }

}
