<?php

use Twitchls\Search;

class SearchApiTest extends TestCase
{
    public function test_games_top()
    {
        $twitchSearch = Mockery::mock('Twitch\Search');

        $api = Mockery::mock('Twitchls\Api');
        $api->shouldReceive('setResource')->once();
        $api->shouldReceive('cachedApiCall')->once()->andReturn('Data');

        $search = new Search($api, $twitchSearch);

        $this->assertEquals('Data', $search->streams('query', 25, 0));
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
