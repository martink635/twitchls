<?php

use Twitchls\Api;

class ApiTest extends TestCase
{

    // Test cached api call

    public function test_not_cached_api_call()
    {
        $cache = Mockery::mock('Illuminate\Contracts\Cache\Repository');
        $cache->shouldReceive('has')->once()->andReturn(true);
        $cache->shouldReceive('put')->once()->andReturn(true);
        $cache->shouldReceive('get')->once()->andReturn('data');

        $transformer = Mockery::mock('Twitchls\Transformers\Transformer');

        $log = Mockery::mock('Twitchls\Logger\Writer');
        $log->shouldReceive('requestNotCached')->once();
        $log->shouldReceive('write')->once();

        // Partial Mock
        $api = Mockery::mock('Twitchls\Api[apiCall]', [$cache, $transformer, $log]);
        $api->shouldReceive('apiCall')->once();

        $result = $api->cachedApiCall(['args'], 'action', 'transformer');

        $this->assertEquals('data', $result);
    }

    public function test_api_call()
    {
        $cache = Mockery::mock('Illuminate\Contracts\Cache\Repository');

        $transformer = Mockery::mock('Twitchls\Transformers\Transformer');
        $transformer->shouldReceive('transform')->once()->andReturn('data');

        $log = Mockery::mock('Twitchls\Logger\Writer');

        $api = new Api($cache, $transformer, $log);
        $api->setResource(new SomeClass);

        $result = $api->apiCall(['args'], 'doSomething', 'transformer');

        $this->assertEquals('data', $result);
    }
}

class SomeClass
{
    public function doSomething()
    {
        return true;
    }
}
