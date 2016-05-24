<?php

use Twitchls\Streams;

class StreamsApiTest extends TestCase
{
    protected $streams;

    protected function setUp()
    {
        $twitchStreams = Mockery::mock('Twitch\Streams');

        $api = Mockery::mock('Twitchls\Api');
        $api->shouldReceive('setResource')->once();
        $api->shouldReceive('cachedApiCall')->once()->andReturn('Data');

        $this->streams = new Streams($api, $twitchStreams);
    }

    public function test_streams_all()
    {
        $this->assertEquals('Data', $this->streams->all('', 25, 0));
    }

    public function test_streams_get()
    {
        $this->assertEquals('Data', $this->streams->get(''));
    }

    public function test_streams_followed()
    {
        $this->assertEquals('Data', $this->streams->followed('token', 25, 0));
    }

    public function tearDown()
    {
      Mockery::close();
    }
}
