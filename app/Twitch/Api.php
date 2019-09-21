<?php

namespace Twitch;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Twitch\Exceptions\ConnectionException;

class Api
{
    /**
     * Twitch API url.
     *
     * @var string
     */
    const URL = 'https://api.twitch.tv/kraken/';

    /**
     * Twitch API version.
     *
     * @var string
     */
    const VERSION = 'v5';

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Options.
     *
     * @var array
     */
    public $options = [];

    /**
     * We setup the default Twitch API options.
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        $this->resetOptions();
    }

    /**
     *  Twitch GET request.
     *
     * @param  string
     *
     * @throws ConnectionException
     *
     * @return object
     */
    public function get($endpoint)
    {
        try {
            $response = $this->client->get($endpoint, $this->options);
        } catch (Exception $exception) {
            throw new ConnectionException();
        }

        return $this->resetOptions()->json($response);
    }

    /**
     *  Twitch POST request.
     *
     * @param  string
     *
     * @throws ConnectionException
     *
     * @return object
     */
    public function post($endpoint)
    {
        try {
            $response = $this->client->post($endpoint, $this->options);
        } catch (Exception $exception) {
            throw new ConnectionException();
        }

        return $this->resetOptions()->json($response);
    }

    /**
     * Sets the neccessary options for Authorization.
     *
     * @param string $token
     *
     * @return Api
     */
    public function auth($token)
    {
        $auth_params = [
            'headers' => [
                'Authorization' => "OAuth {$token}",
            ],
        ];

        return $this->options($auth_params);
    }

    /**
     * Merges the current options with an array.
     *
     * @param array $options
     *
     * @return Api
     */
    public function options($options)
    {
        $this->options = array_replace_recursive($this->options, $options);

        return $this;
    }

    /**
     * Set options to the default values.
     *
     * @return api
     */
    protected function resetOptions()
    {
        $this->options = [
            'base_uri' => static::URL,
            'headers'  => [
                'Client-ID' => env('TWITCH_CLIENT_ID', ''),
                'Accept'    => "application/vnd.twitchtv.v5+json",
            ],
        ];

        return $this;
    }

    /**
     * Returns an object from the Guzzle response.
     *
     * @param Response $response
     *
     * @return object
     */
    protected function json(Response $response)
    {
        return json_decode($response->getBody()->getContents());
    }
}
