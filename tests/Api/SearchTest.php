<?php

use Twitch\Search;

class SearchTest extends TestCase
{

    public function test_search()
    {
        $twitch = Mockery::mock('Twitch\Api');
        $twitch->shouldReceive('options->get')
               ->once()
               ->with('search/streams')
               ->andReturn((object) ['streams' => 'result']);

        $search = new Search($twitch);

        $this->assertEquals($search->streams('query'), 'result');
    }

    public function tearDown()
    {
      Mockery::close();
    }
}
