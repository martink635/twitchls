<?php

use Twitchls\Games;

class GamesApiTest extends TestCase
{
    public function test_games_top()
    {
        $twitchGames = Mockery::mock('Twitch\Games');

        $api = Mockery::mock('Twitchls\Api');
        $api->shouldReceive('setResource')->once();
        $api->shouldReceive('cachedApiCall')->once()->andReturn('Data');

        $games = new Games($api, $twitchGames);

        $this->assertEquals('Data', $games->top(25, 0));
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
