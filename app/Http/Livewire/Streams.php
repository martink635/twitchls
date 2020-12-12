<?php

namespace App\Http\Livewire;

use Livewire\Component;
use romanzipp\Twitch\Twitch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Livewire\Traits\FormatStreamsTrait;

class Streams extends Component
{
    use FormatStreamsTrait;

    public $streams = [];
    public $games = [];
    public $filter = null;
    public $filterName = '';
    public $cursor = null;
    public $next = true;

    public $filteredGames = [];
    public $highlightIndex = 0;
    public $query = '';

    protected Twitch $twitch;

    public function mount(Twitch $twitch)
    {
        if (Auth::user()) {
            $this->filter = 'followed';
        }

        $this->getStreams($twitch);
        $this->twitch = $twitch;

        $this->games = Cache::remember(
            'games', 180, function () {
                $result = $this->twitch->getTopGames(['first' => 100]);

                return collect(
                    $result->data()
                )->map(
                    function ($item) {
                        return collect($item)->toArray();
                    }
                )->toArray();
            }
        );

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

    private function getStreams(Twitch $twitch, $cursor = null)
    {
        $this->twitch = $twitch;

        $query = ['first' => 18, 'after' => $cursor];
        $cacheKey = "streams_{$cursor}_{$this->filter}";

        if (Auth::user() && $this->filter === 'followed') {
            $id = Auth::id();

            $follows = Cache::remember(
                "followed_users_{$id}", 0, function () {
                    $cursor = null;
                    $data = [];

                    do {
                        $result = $this->twitch->getUsersFollows(['from_id' => Auth::id(), 'first' => 100], $cursor);
                        array_push($data, ...$result->data());
                        $cursor = $result->next();
                    } while ($result->hasMoreResults());

                    return collect($data)->map(
                        function ($item) {
                            return $item->to_id;
                        }
                    )->toArray();
                }
            );

            $query['first'] = 100;
            $query['user_id'] = $follows;
            $cacheKey = "streams_{$cursor}_{$id}";
        } else {
            $query['game_id'] = $this->filter;
        }

        $cache = Cache::remember(
            $cacheKey, 120, function () use ($query) {
                return $this->formatStreams($this->twitch->getStreams($query));
            }
        );

        $this->streams = array_merge($this->streams, $cache['streams']->toArray());
        $this->cursor = $cache['cursor'];
        $this->next = $cache['next'];
    }

    public function updatedQuery()
    {
        if (empty($this->query)) {
            $this->filteredGames = $this->games;
            return;
        }

        $this->filteredGames = collect(
            $this->games
        )->filter(
            function ($item) {
                return strpos(strtolower($item['name']), strtolower($this->query)) === false ? false : true;
            }
        )->toArray();
    }

    public function filterBy(Twitch $twitch, $value)
    {
        $this->filter = $value;
        $this->streams = [];

        if ($this->filter !== null && $this->filter !== 'followed') {
            $this->filterName = collect($this->games)->where('id', $this->filter)->first()['name'];
        }

        $this->getStreams($twitch);
    }

    public function filterByHighlight(Twitch $twitch)
    {
        if (count($this->filteredGames) === 0) {
            return;
        }

        $this->filterBy($twitch, $this->filteredGames[$this->highlightIndex]['id']);
    }

    public function loadMore(Twitch $twitch, $cursor)
    {
        $this->getStreams($twitch, $cursor);
    }

    public function render()
    {
        return view('livewire.streams');
    }
}
