<?php

namespace App\Transformers;

class StreamTransformer implements TransformerInterface
{
    public function transform($stream)
	{
	    return [
            'streamer'  => $stream->channel->display_name,
            'title'     => isset($stream->channel->status) ? $stream->channel->status : "Untitled Broadcast",
            'channel'   => $stream->channel->name,
            'game'      => $stream->game,
            'viewers'   => number_format($stream->viewers),
            'preview'   => $stream->preview->large,
	    ];
	}
}
