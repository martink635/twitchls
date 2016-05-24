<?php

use Twitch\Api;

class TwitchApiTest extends TestCase
{

    /**
     * @test
     * @expectedException Twitch\Exceptions\ConnectionException
     */
    public function throws_exception_when_post_fails()
    {
        $client = Mockery::mock('GuzzleHttp\Client');
        $client->shouldReceive('post')
               ->once()
               ->andThrow('Twitch\Exceptions\ConnectionException');

        $twitch = new Api($client);
        $twitch->post('');
    }

    /**
     * @test
     */
    public function returns_json_from_api_post()
    {
        $response = Mockery::mock('GuzzleHttp\Psr7\Response');
        $response->shouldReceive('getBody->getContents')->andReturn('{"a":1}');

        $client = Mockery::mock('GuzzleHttp\Client');
        $client->shouldReceive('post')->once()->andReturn($response);

        $twitch = new Api($client);
        $this->assertEquals((object) ['a' => 1], $twitch->post(''));
    }

    /**
     * @test
     */
    public function returns_json_from_api_as_an_object()
    {
        $response = Mockery::mock('GuzzleHttp\Psr7\Response');
        $response->shouldReceive('getBody->getContents')->andReturn('{"a":1}');

        $client = Mockery::mock('GuzzleHttp\Client');
        $client->shouldReceive('get')->once()->andReturn($response);

        $twitch = new Api($client);
        $this->assertEquals((object) ['a' => 1], $twitch->get(''));
    }

    /**
     * @test
     */
    public function options_can_be_overwritten()
    {
        $client = Mockery::mock('GuzzleHttp\Client');

        $twitch = new Api($client);
        $twitch->options(['base_uri' => 'uri']);

        $this->assertEquals('uri', $twitch->options['base_uri']);
    }

    /**
     * @test
     */
    public function authorization_token_is_added_to_options()
    {
        $client = Mockery::mock('GuzzleHttp\Client');

        $twitch = new Api($client);
        $twitch->auth('token');

        $this->assertEquals('OAuth token', $twitch->options['headers']['Authorization']);
    }

    /**
     * @test
     * @expectedException Twitch\Exceptions\ConnectionException
     */
    public function throws_exception_when_twitch_is_unavailable()
    {
        $client = Mockery::mock('GuzzleHttp\Client');
        $client->shouldReceive('get')
               ->once()
               ->andThrow('Twitch\Exceptions\ConnectionException');

        $twitch = new Api($client);
        $twitch->get('');
    }

    public function tearDown()
    {
      Mockery::close();
    }
}
