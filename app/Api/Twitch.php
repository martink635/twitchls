<?php

namespace App\Api;

use GuzzleHttp\Client;

class Twitch
{
    /**
     * Twitch API url
     */
    const URL = "https://api.twitch.tv/kraken/";

    /**
     * Twitch API version
     */
    const VERSION = "v3";

    /**
     * GuzzleHttp\Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => static::URL,
            'defaults' => [
                'headers' => [
                    'Accept' => "application/vnd.twitchtv.{static::VERSION}+json"
                ]
            ]
        ]);
    }

    /**
     *  Twitch GET request, with options
     *
     * @param  string
     * @param  array
     * @return object
     */
    public function get($endpoint, $options = [])
    {
        $response = $this->client->get($endpoint, $options);

        return $this->json($response);
    }

    /**
     * Returns an object from the Guzzle response
     *
     * @param  GuzzleHttp\Psr7\Response
     * @return object
     */
    private function json($response)
    {
        return json_decode($response->getBody()->getContents());
    }
}
