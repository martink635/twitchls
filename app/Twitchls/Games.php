<?php

namespace Twitchls;

use Twitch\Games as TwitchGames;
use Twitchls\Api;
use Twitchls\Transformers\GameTransformer;

class Games
{
    /**
     * Twitchls Api
     * @var Twitchls\Api
     */
    protected $api;

    public function __construct(Api $api, TwitchGames $games)
    {
        $this->api = $api;
        $this->api->setResource($games);
    }

    /**
     * Retrieves a list of all streams. Can be filtered by game name.
     *
     * @param string  $game
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function top($limit, $offset)
    {
        return $this->api->cachedApiCall(func_get_args(), 'top', new GameTransformer);
    }

}
