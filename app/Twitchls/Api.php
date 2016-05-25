<?php

namespace Twitchls;

use Illuminate\Contracts\Cache\Repository as Cache;
use Twitchls\Logger\Writer;
use Twitchls\Transformers\Transformer;

class Api
{
    /**
     * Cache Repository Contract.
     *
     * @var Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Cache persistence in minutes.
     *
     * @var int
     */
    protected $cacheMinutes = 3;

    /**
     * Transformer.
     *
     * @var Twitchls\Transformers\Transformer
     */
    protected $transformer;

    /**
     * Log Writer.
     *
     * @var Twitchls\Logger\Writer
     */
    protected $log;

    /**
     * Twitch api endpoint resource.
     *
     * @var mixed
     */
    public $resource;

    public function __construct(Cache $cache, Transformer $transformer, Writer $log)
    {
        $this->cache = $cache;
        $this->transformer = $transformer;
        $this->log = $log;
    }

    /**
     * Sets the current resource.
     *
     * @param  $resource mixed
     *
     * @return void
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Retrieves the api call result from cache. If expired, calls
     * apiCall to get a new array and stores it in the cache before
     * returning it.
     *
     * @param array                $args
     * @param string               $action
     * @param TransformerInterface $transformer
     * @param bool                 $collection
     * @param bool                 $clearCache
     *
     * @return array
     */
    public function cachedApiCall($args, $action, $transformer, $collection = true)
    {
        $key = $this->getCacheKey($args);

        if ((!$this->cache->has($key)) || $this->isCli()) {
            $this->log->requestNotCached();

            $obj = $this->apiCall($args, $action, $transformer, $collection);

            $this->cache->put($key, $obj, $this->cacheMinutes);
        }

        $this->log->write(get_class($this->resource).'\\'.$action, $args);

        return $this->cache->get($key);
    }

    /**
     * Performs an API $action call, passes the $args array
     * and transforms the result using the given $transformer.
     *
     * @param array                $args
     * @param string               $action
     * @param TransformerInterface $transformer
     * @param bool                 $collection
     *
     * @return array
     */
    public function apiCall($args, $action, $transformer, $collection = true)
    {
        $list = call_user_func_array([$this->resource, $action], $args);

        return $this->transformer->transform($list, $transformer, $collection);
    }

    /**
     * Returns a string based on the given class name
     * and query options.
     *
     * @param array $args
     *
     * @return string
     */
    protected function getCacheKey($args)
    {
        return get_class($this->resource).'_'.implode('_', $args);
    }

    /**
     * Returns true if php is invoked from the command line.
     *
     * @return bool
     */
    protected function isCli()
    {
        return php_sapi_name() === 'cli';
    }
}
