<?php

namespace Twitchls\Transformers;

class GameTransformer implements TransformerInterface
{
    public function transform($game)
    {
        return [
            'name'       => $game->game->name,
            'channels'   => number_format($game->channels),
            'viewers'    => number_format($game->viewers),
        ];
    }
}
