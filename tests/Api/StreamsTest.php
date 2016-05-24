<?php

use Twitch\Streams;

class StreamsTest extends TestCase
{

    /**
     * @test
     */
    public function test_get()
    {

        $twitch = Mockery::mock('Twitch\Api');
        $twitch->shouldReceive('get')
               ->once()
               ->with('streams/name')
               ->andReturn((object) ['stream' => 'name']);

        $streams = new Streams($twitch);

        $this->assertEquals($streams->get('name'), 'name');
    }

    /**
     * @test
     */
    public function test_all()
    {
        $twitch = Mockery::mock('Twitch\Api');
        $twitch->shouldReceive('options->get')
               ->once()
               ->with('streams')
               ->andReturn((object) ['streams' => 'streams']);

        $streams = new Streams($twitch);

        $this->assertEquals($streams->all(), 'streams');
    }

    /**
     * @test
     */
    public function test_followed()
    {
        $twitch = Mockery::mock('Twitch\Api');
        $twitch->shouldReceive('auth->options->get')
               ->once()
               ->with('streams/followed')
               ->andReturn((object) ['streams' => 'followed']);

        $streams = new Streams($twitch);

        $this->assertEquals($streams->followed('token'), 'followed');
    }

    public function tearDown()
    {
      Mockery::close();
    }
}
