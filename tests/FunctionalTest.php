<?php

class FunctionalTest extends TestCase
{
    public function testPageLoads()
    {
        $this->visit('/')
             ->see('twitc');
    }

    public function testInvalidStreamRedirect()
    {
        $this->visit('invalidstreamname')
             ->seePageIs('/');
    }

    public function testApiStreams()
    {
        $this->visit('api/v1/streams/50/0')
             ->seeJson();
    }

    public function testApiGames()
    {
        $this->visit('api/v1/games/5')
             ->seeJson();
    }
}
