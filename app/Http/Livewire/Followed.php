<?php

namespace App\Http\Livewire;

use Livewire\Component;
use romanzipp\Twitch\Twitch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Followed extends Component
{
    public $filter = 'followed';
    public $streams = [];

    public function mount(Twitch $twitch)
    {
        if (Auth::guest()) {
            return;
        }

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
                $result = $this->twitch->getStreams($query);

                return [
                    'next' => $result->hasMoreResults(),
                    'cursor' => $result->paginator->cursor(),
                    'streams' => collect(
                        $result->data()
                    )->map(
                        function ($item) {
                            $item->thumbnail_352 = str_replace('{width}', '352', $item->thumbnail_url);
                            $item->thumbnail_352 = str_replace('{height}', '198', $item->thumbnail_352);

                            $item->thumbnail_480 = str_replace('{width}', '480', $item->thumbnail_url);
                            $item->thumbnail_480 = str_replace('{height}', '270', $item->thumbnail_480);

                            $item->thumbnail_640 = str_replace('{width}', '640', $item->thumbnail_url);
                            $item->thumbnail_640 = str_replace('{height}', '360', $item->thumbnail_640);

                            $item->thumbnail_768 = str_replace('{width}', '768', $item->thumbnail_url);
                            $item->thumbnail_768 = str_replace('{height}', '432', $item->thumbnail_768);

                            $item->thumbnail_url = str_replace('{width}', '960', $item->thumbnail_url);
                            $item->thumbnail_url = str_replace('{height}', '540', $item->thumbnail_url);

                            return collect($item)->toArray();
                        }
                    ),
                ];
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
