<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twitchls\Games;
use Twitchls\Streams;

class PreCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'precache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prefetches the most popural API results into cache.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Streams $streams, Games $games)
    {
        // Cache the first 3 pages of streams and the gamelist
        $streams->all('', 30, 0);
        $streams->all('', 30, 30);
        $streams->all('', 30, 60);
        $games->top(100, 0);
    }
}
