<?php

namespace Twitchls;

use Twitch\Streams as TwitchStreams;
use Twitchls\Transformers\StreamTransformer;

class Streams
{
    /**
     * Twitchls Api.
     *
     * @var Twitchls\Api
     */
    protected $api;

    public function __construct(Api $api, TwitchStreams $streams)
    {
        $this->api = $api;
        $this->api->setResource($streams);
    }

    /**
     * Retrieves a list of all streams. Can be filtered by game name.
     *
     * @param string $game
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function all($game, $limit, $offset)
    {
        return $this->api->cachedApiCall(func_get_args(), 'all', new StreamTransformer());
    }

    /**
     * Retrieves a single stream by its name.
     *
     * @param string $name
     *
     * @return array
     */
    public function get($name)
    {
        return $this->api->cachedApiCall(func_get_args(), 'get', new StreamTransformer(), false);
    }

    /**
     * Retrieves a list of followed streams.
     *
     * @param string $game
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function followed($token, $limit, $offset)
    {
        return $this->api->cachedApiCall(func_get_args(), 'followed', new StreamTransformer());
    }
}
