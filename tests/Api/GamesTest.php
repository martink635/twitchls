<?php

use Twitch\Games;

class GamesTest extends TestCase
{
    public function test_search()
    {
        $twitch = Mockery::mock('Twitch\Api');
        $twitch->shouldReceive('options->get')
               ->once()
               ->with('games/top')
               ->andReturn((object) ['top' => 'result']);

        $games = new Games($twitch);

        $this->assertEquals($games->top(), 'result');
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
