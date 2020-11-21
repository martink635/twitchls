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

        $this->games = \Cache::remember('games', 180, function() use($twitch) {
            $result = $twitch->getTopGames(['first' => 50]);

            return collect($result->data())->map(function ($item) {
                return collect($item)->toArray();
            })->toArray();
        });

        $this->filteredGames = $this->games;
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
        $cache = \Cache::remember("streams_{$cursor}_{$this->filter}", 120, function() use($cursor) {
            $twitch = new Twitch;
            $result = $twitch->getStreams(['first' => 18, 'after' => $cursor, 'game_id' => $this->filter ]);

            return [
                'cursor' => $result->paginator->cursor(),
                'streams' => collect($result->data())->map(function ($item) {
                        $item->thumbnail_url = str_replace('{width}', '480', $item->thumbnail_url);
                        $item->thumbnail_url = str_replace('{height}', '270', $item->thumbnail_url);

                        return collect($item)->toArray();
                    })->toArray(),
            ];
        });

        $this->streams = array_merge($this->streams, $cache['streams']);
        $this->cursor = $cache['cursor'];
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
