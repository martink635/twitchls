<?php

namespace App\Auth;

use Cache;
use Illuminate\Support\Str;

class User
{
    /**
     * Twitch unique user id
     * @var integer
     */
    public $id;

    /**
     * Twitch login name
     * @var string
     */
    public $name;

    /**
     * Twitch display name
     * @var string
     */
    public $display_name;

    /**
     * Twitch API token
     * @var string
     */
    public $token;

    /**
     * Random identifier for making API requests
     * @var string
     */
    public $identifier;

    /**
     * Set the user properties and return the user.
     *
     * @param  array  $attributes
     * @return \App\Auth\User
     */
    public function map(array $attributes)
    {
        $this->id = $attributes['_id'];
        $this->name = $attributes['name'];
        $this->display_name = $attributes['display_name'];
        $this->token = $attributes['token'];
        $this->identifier = Str::random(32);

        // We store the identifier in the Cache,
        // pointing to a token for safer retrieval
        Cache::put($this->identifier, $this->token, 0);

        return $this;
    }
}
