<?php

namespace Twitchls\Auth;

use Twitch\Api as TwitchApi;
use Twitchls\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Twitch
{
    /**
     * Twitch Client Id
     * @var string
     */
    protected $clientId;

    /**
     * Twitch Client Secret
     * @var string
     */
    protected $clientSecret;

    /**
     * Twitch Redirect URL
     * @var string
     */
    protected $redirectUrl;

    /**
     * Request
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * Twitch API
     * @var App\Api\Twitch
     */
    protected $twitch;

    /**
     * List of scopes
     * @var array
     */
    protected $scopes = ['user_read'];

    /**
     * Twitch API Token endpoint
     * @var string
     */
    protected $tokenUrl = 'oauth2/token';

    /**
     * Twitch full authorization URL
     * @var string
     */
    protected $authUrl = 'https://api.twitch.tv/kraken/oauth2/authorize';

    /**
     * Sets the Twitch Client information from the environment.
     *
     * @return void
     */
    public function __construct(Request $request, TwitchApi $twitch)
    {
        $this->request = $request;
        $this->twitch = $twitch;

        $this->clientId = env('TWITCH_CLIENT_ID');
        $this->clientSecret = env('TWITCH_CLIENT_SECRET');
        $this->redirectUrl = env('TWITCH_REDIRECT_URL');
    }

    /**
     * Redirects to the Twitch authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        $this->request->session()->set('state', $state = Str::random(40));

        return new RedirectResponse($this->getAuthUrl($state));
    }

    /**
     * Generates the Twitch authentication URL, using the provided state.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->authUrl . '?' . http_build_query($this->getCodeFields($state));
    }

    /**
     * Setup the URL parameters for the authentication
     *
     * @param  string $state
     * @return array
     */
    protected function getCodeFields($state)
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => $this->formatScopes($this->scopes),
            'response_type' => 'code',
            'state' => $state
        ];

        return $fields;
    }

    /**
     * Format the provided Twitch scopes using a space as a delimiter.
     *
     * @param  array  $scopes
     * @return string
     */
    protected function formatScopes(array $scopes)
    {
        return implode(' ', $scopes);
    }

    /**
     * Retrieves the User from Twitch
     *
     * @return \App\Auth\User
     */
    public function getUser()
    {
        $token = $this->getAccessToken();

        $user = (array) $this->twitch->auth($token)->get('user');
        $user['token'] = $token;

        return (new User)->map($user);
    }

    /**
     * Retrieves the access_token
     *
     * @return string
     */
    protected function getAccessToken()
    {
        $response = $this->twitch->options($this->getTokenFields())->post($this->tokenUrl);

        return $response->access_token;
    }

    /**
     * Fills out the required fields for gettin the Twitch
     * authorization token.
     *
     * @return array
     */
    protected function getTokenFields()
    {
        return [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'authorization_code',
                'redirect_uri' =>$this->redirectUrl,
                'code' => $this->getCode(),
                'state' => $this->request->session()->get('state'),
            ]
        ];
    }

    /**
     * Gets the code from the Request
     *
     * @return string
     */
    protected function getCode()
    {
        return $this->request->get('code');
    }
}
