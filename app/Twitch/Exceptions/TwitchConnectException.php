<?php

namespace Twitch\Exceptions;

class TwitchConnectException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Connection to Twitch.tv API failed.';

        parent::__construct();
    }
}
