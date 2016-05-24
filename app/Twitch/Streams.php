<?php

namespace Twitch;

use Twitch\Api;

class Streams
{

    /**
     * Api endpoints
     * @var Array
     */
    protected $endpoint;

    /**
     * Twitch Object
     * @var Twitch
     */
    protected $twitch;

    public function __construct(Api $twitch)
    {
        $this->endpoint[0] = "streams";
        $this->endpoint[1] = "streams/followed";
        $this->twitch = $twitch;
    }

    /**
     * Retrieves a single stream by its name.
     *
     * @param  string
     * @return object
     */
    public function get($name)
    {
        return $this->twitch->get("{$this->endpoint[0]}/${name}")->stream;
    }

    /**
     * Retrieves a list of live streams.
     *
     * By default retrieves streams for all games.
     * Twitch API limits the retrieveal to 100 streams at a time.
     *
     * @param  string
     * @param  integer
     * @param  integer
     * @return object
     */
    public function all($game = '', $limit = 50, $offset = 0)
    {
        $options = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
                'game' => $game
            ]
        ];

        return $this->twitch
                    ->options($options)
                    ->get($this->endpoint[0])->streams;
    }

    /**
     * Retrieves a list of live streams the authenticated user is
     * following and are currently streaming.
     *
     * Twitch API limits the retrieveal to 100 streams at a time.
     *
     * @param  string
     * @param  integer
     * @param  integer
     * @return object
     */
    public function followed($token, $limit = 50, $offset = 0)
    {
        $options = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset
            ]
        ];

        return $this->twitch
                    ->auth($token)
                    ->options($options)
                    ->get($this->endpoint[1])->streams;
    }
}
