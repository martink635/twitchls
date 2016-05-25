<?php

namespace Twitchls\Logger;

use Illuminate\Http\Request;
use Illuminate\Session\Store;

class Writer
{
    /**
     * @var Twitchls\Logger\HandlerInterface
     */
    protected $handler;

    /**
     * Default value.
     *
     * @var bool
     */
    protected $cached = true;

    /**
     * @var Illuminate\Session\Store;
     */
    protected $session;

    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    public function __construct(HandlerInterface $handler, Store $session, Request $request)
    {
        $this->handler = $handler;
        $this->session = $session;
        $this->request = $request;
    }

    /**
     * Write the log using the given handler.
     *
     * @param string $text
     *
     * @return void
     */
    public function write($endpoint, $options)
    {
        $user = $this->isCli();

        if ($this->session->has('user')) {
            $user = $this->session->get('user')->id;
        }

        $this->handler->write($user,
                              $endpoint,
                              $options,
                              $this->request->ip(),
                              $this->cached);
    }

    /**
     * Sets cached to false.
     *
     * @return void
     */
    public function requestNotCached()
    {
        $this->cached = false;
    }

    /**
     * Returns CLI if run from CLI, null otherwise.
     *
     * @return mixed
     */
    protected function isCli()
    {
        if (php_sapi_name() === 'cli') {
            return 'cli';
        }
    }
}
