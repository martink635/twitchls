<?php

use Twitchls\Transformers\GameTransformer;
use Twitchls\Transformers\StreamTransformer;
use Twitchls\Transformers\Transformer;

class TransformersTest extends TestCase
{
    public function test_transformer_with_single()
    {
        $raw = [
            'key'    => 0,
            'unused' => 0,
        ];

        $expected = ['key' => 1];

        $transformer = new Transformer();
        $result = $transformer->transform($raw, function ($item) {
            return [
                'key' => $item['key'] + 1,
            ];
        }, false);

        $this->assertEquals($expected, $result);
    }

    public function test_transformer_with_anonymous_function()
    {
        $raw = [
            [
                'key'    => 0,
                'unused' => 0,
            ],
        ];

        $expected = [
            [
                'key' => 1,
            ],
        ];

        $transformer = new Transformer();
        $result = $transformer->transform($raw, function ($item) {
            return [
                'key' => $item['key'] + 1,
            ];
        });

        $this->assertEquals($expected, $result);
    }

    public function test_game_transformer()
    {
        $gamesRaw = (object) [
            (object) [
                'viewers'  => 10000,
                'channels' => 100,
                'game'     => (object) [
                    'name' => 'Game name 1',
                ],
            ],
            (object) [
                'viewers'  => 5000,
                'channels' => 50,
                'game'     => (object) [
                    'name' => 'Game name 2',
                ],
            ],
        ];

        $gamesExpected = [
            [
                'name'     => 'Game name 1',
                'viewers'  => '10,000',
                'channels' => '100',
            ],
            [
                'name'     => 'Game name 2',
                'viewers'  => '5,000',
                'channels' => '50',
            ],
        ];

        $transformer = new Transformer();
        $result = $transformer->transform($gamesRaw, new GameTransformer());

        $this->assertEquals($gamesExpected, $result);
    }

    public function test_stream_transformer()
    {
        $streamsRaw = (object) [
            (object) [
                'game'    => 'Game title',
                'viewers' => '1000',
                'preview' => (object) [
                    'template' => 'preview_{width}_{height}',
                ],
                'channel' => (object) [
                    'status'       => 'Stream title',
                    'display_name' => 'Streamer name',
                    'name'         => 'Channel name',
                ],
            ],
            (object) [
                'game'    => 'Game title 2',
                'viewers' => '1500',
                'preview' => (object) [
                    'template' => 'preview_{width}_{height}',
                ],
                'channel' => (object) [
                    'status'       => 'Stream title 2',
                    'display_name' => 'Streamer name 2',
                    'name'         => 'Channel name 2',
                ],
            ],
        ];

        $streamsExpected = [
            [
                'streamer' => 'Streamer name',
                'title'    => 'Stream title',
                'channel'  => 'Channel name',
                'game'     => 'Game title',
                'viewers'  => '1,000',
                'preview'  => 'preview_567_324',
            ],
            [
                'streamer' => 'Streamer name 2',
                'title'    => 'Stream title 2',
                'channel'  => 'Channel name 2',
                'game'     => 'Game title 2',
                'viewers'  => '1,500',
                'preview'  => 'preview_567_324',
            ],
        ];

        $transformer = new Transformer();
        $result = $transformer->transform($streamsRaw, new StreamTransformer());

        $this->assertEquals($streamsExpected, $result);
    }

    public function test_stream_transformer_with_missing_status()
    {
        $streamsRaw = (object) [
            (object) [
                'game'    => 'Game title',
                'viewers' => '1000',
                'preview' => (object) [
                    'template' => 'preview_{width}_{height}',
                ],
                'channel' => (object) [
                    'display_name' => 'Streamer name',
                    'name'         => 'Channel name',
                ],
            ],
        ];

        $streamsExpected = [
            [
                'streamer' => 'Streamer name',
                'title'    => 'Untitled Broadcast',
                'channel'  => 'Channel name',
                'game'     => 'Game title',
                'viewers'  => '1,000',
                'preview'  => 'preview_567_324',
            ],
        ];

        $transformer = new Transformer();
        $result = $transformer->transform($streamsRaw, new StreamTransformer());

        $this->assertEquals($streamsExpected, $result);
    }
}
