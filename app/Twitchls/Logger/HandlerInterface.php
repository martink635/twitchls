<?php

namespace Twitchls\Logger;

interface HandlerInterface
{
    public function write($user, $endpoint, $options, $ip, $cached);
}
