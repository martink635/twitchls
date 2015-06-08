<?php namespace App\Api;

use App\Api\Twitch;

class Streams {

    public function __construct(Twitch $twitch)
    {
        $this->endpoint = "streams";
        $this->twitch = $twitch;
    }

    /**
     * Retrieves a single stream by its name
     * 
     * @param  string
     * @return object
     */
    public function get($name)
    {
        return $this->twitch->get("{$this->endpoint}/${name}");
    }

    /**
     * Retrieves a list of live streams
     * 
     * By default retrieves streams for all games.
     * Twitch API limits the retrieveal to 100 streams at a time.
     * 
     * @param  string
     * @param  integer
     * @param  integer
     * @return object
     */
    public function all($game = "", $limit = 50, $offset = 0)
    {
        $options = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
                'game' => $game,
                'hls' => 'true'
            ]
        ];

        return $this->twitch->get("{$this->endpoint}", $options);
    }
}