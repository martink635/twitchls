<?php

namespace App\Http\Livewire;

use Livewire\Component;
use romanzipp\Twitch\Twitch;
use romanzipp\Twitch\Helpers\Paginator;

class Streams extends Component
{

    public $streams = [];
    public $games = [];
    public $filter = null;
    public $filterName = '';
    public $cursor = null;

    public $filteredGames = [];
    public $highlightIndex = 0;
    public $query = '';

    public function mount()
    {
        $this->getStreams();

        $twitch = new Twitch;
        $result = $twitch->getTopGames(['first' => 50]);
        $this->games = collect($result->data())->map(function ($item) {
            return collect($item)->toArray();
        })->toArray();

        $this->filteredGames = $this->games;

        // $this->streams = \Cache::remember('streams', 60, function() use($twitch) {
        //     $result = $twitch->getStreams();
        //     $cusror = $twitch->getStreams()->paginator->cursor();


        //     return collect($twitch->getStreams()->data())->map(function ($item) {
        //         $item->thumbnail_url = str_replace('{width}', '1280', $item->thumbnail_url);
        //         $item->thumbnail_url = str_replace('{height}', '720', $item->thumbnail_url);

        //         return $item;
        //     });
        // });

    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->filteredGames) - 1) {
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            return;
        }

        $this->highlightIndex--;
    }

    private function getStreams($cursor = null)
    {
        $twitch = new Twitch;
        $result = $twitch->getStreams(['first' => 18, 'after' => $cursor, 'game_id' => $this->filter ]);

        $this->streams = array_merge($this->streams,
            collect($result->data())->map(function ($item) {
                $item->thumbnail_url = str_replace('{width}', '1280', $item->thumbnail_url);
                $item->thumbnail_url = str_replace('{height}', '720', $item->thumbnail_url);

                return collect($item)->toArray();
            })->toArray()
        );

        $this->cursor = $result->paginator->cursor();
    }

    public function updatedFilter()
    {
        $this->streams = [];
        $this->getStreams();
    }

    public function updatedQuery()
    {
        if (empty($this->query)) {
            $this->filteredGames = $this->games;
            return;
        }

        $this->filteredGames = collect($this->games)->filter(function ($item) {
            return strpos(strtolower($item['name']), strtolower($this->query)) === false ? false : true;
        })->toArray();
    }

    public function filterBy($game_id)
    {
        $this->filter = $game_id;
        $this->filterName = collect($this->games)->where('id', $this->filter)->first()['name'];
        $this->streams = [];
        $this->getStreams();
    }

    public function filterByHighlight()
    {
        $this->filter = $this->filteredGames[$this->highlightIndex]['id'];
        $this->filterName = collect($this->games)->where('id', $this->filter)->first()['name'];
        $this->streams = [];
        $this->getStreams();
    }

    public function resetFilter()
    {
        $this->filter = null;
        $this->filterName = '';
        $this->streams = [];
        $this->getStreams();
    }

    public function loadMore($cursor)
    {
        $this->getStreams($cursor);
    }

    public function render()
    {
        return view('livewire.streams');
    }
}
