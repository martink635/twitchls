<?php

namespace App\Http\Livewire;

use Livewire\Component;
use romanzipp\Twitch\Twitch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Livewire\Traits\FormatStreamsTrait;

class Followed extends Component
{
    use FormatStreamsTrait;

    public $filter = 'followed';
    public $streams = [];

    public function mount(Twitch $twitch)
    {
        if (Auth::guest()) {
            return;
        }

        $this->getStreams($twitch);
    }

    public function poll(Twitch $twitch)
    {
        $this->streams = [];
        $this->getStreams($twitch);
    }

    private function getStreams(Twitch $twitch, $cursor = null)
    {
        $this->twitch = $twitch;

        $query = ['first' => 18, 'after' => $cursor];
        $cacheKey = "streams_{$cursor}_{$this->filter}";

        if (Auth::user() && $this->filter === 'followed') {
            $id = Auth::id();

            $follows = Cache::remember(
                "followed_users_{$id}", 300, function () {
                    $result = $this->twitch->getUsersFollows(['from_id' => Auth::id(), 'first' => 100]);

                    return collect(
                        $result->data()
                    )->map(
                        function ($item) {
                            return $item->to_id;
                        }
                    )->toArray();
                }
            );

            $query['user_id'] = $follows;
            $cacheKey = "streams_{$cursor}_{$id}";
        }

        $cache = Cache::remember(
            $cacheKey, 120, function () use ($query) {
                return $this->formatStreams($this->twitch->getStreams($query));
            }
        );

        // Fetch avatars
        if (count($cache['streams']) > 0) {
            $ids = $cache['streams']->map(
                function ($stream) {
                    return $stream['user_id'];
                }
            );

            $result = $this->twitch->getUsers(['user_id' => $ids]);

            // dd($result->data());
        }

        $this->streams = array_merge($this->streams, $cache['streams']->toArray());
    }

    public function render()
    {
        return view('livewire.followed');
    }
}
