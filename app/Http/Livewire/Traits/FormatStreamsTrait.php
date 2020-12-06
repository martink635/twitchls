<?php
namespace App\Http\Livewire\Traits;

trait FormatStreamsTrait
{
    private function formatStreams($result)
    {
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

                    $item->user_name = $this->formatUserName($item->user_name);
                    $item->viewer_count_formatted = $this->formatViewers($item->viewer_count);

                    return collect($item)->toArray();
                }
            ),
        ];
    }

    /**
     * Due to a weird implementation, helix api returns display names instead of
     * user names. We remove the spaces and semicolons, from the display name.
     * This fixes some channels, not all of them
     *
     * https://github.com/twitchdev/issues/issues/3
     */
    private function formatUserName($name)
    {
        return str_replace([' ', ':'], '', $name);
    }

    private function formatViewers($count)
    {
        if ($count >= 1000 && $count < 100000) {
            // 16.4k
            return round($count / 1000, 1) . 'k';
        } else if ($count >= 100000 && $count < 1000000) {
            // 168k
            return round($count / 1000) . 'k';
        } else if ($count >= 1000000) {
            // 1.45M
            return round($count / 1000000, 2) . 'M';
        }

        return $count;
    }
}
