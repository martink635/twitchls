<?php

namespace Twitchls\Logger;

use Twitchls\Logger\HandlerInterface;
use Twitchls\Logger\Log;

class EloquentHandler implements HandlerInterface
{
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function write($user, $endpoint, $options, $ip, $cached = true)
    {
        $this->log->create(
            [
                'user' => $user,
                'endpoint' => $endpoint,
                'options' => json_encode($options),
                'ip_address' => $ip,
                'cached' => $cached
            ]
        );
    }
}
