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

    public function __construct(Client $client)
    {
        $this->client = $client;
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
        $options = $this->mergeDefaultOptions($options);

        $response = $this->client->get($endpoint, $options);

        return $this->json($response);
    }

    /**
     * Returns an object from the Guzzle response
     *
     * @param  GuzzleHttp\Psr7\Response $response
     * @return object
     */
    private function json(\GuzzleHttp\Psr7\Response $response)
    {
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Merges the default set options with the
     * given array of options.
     *
     * @param  array $options
     * @return array
     */
    private function mergeDefaultOptions(array $options)
    {
        return array_merge([
                    'base_uri' => static::URL,
                    'defaults' => [
                        'headers' => [
                            'Accept' => "application/vnd.twitchtv.{static::VERSION}+json"
                        ]
                    ]
                ], $options);
    }
}
