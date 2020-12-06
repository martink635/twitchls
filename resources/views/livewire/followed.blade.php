@if (Auth::user() && !is_null(Auth::user()->settings) && Auth::user()->settings['followed'])

<div wire:poll.60s class="relative hidden w-12 md:block dark:bg-gray-900" x-data="{ show: false }"
    x-on:mouseenter="show = true" x-on:mouseleave="show = false">

    <div x-cloak :class="{ 'w-64 z-20': show, 'w-12': !show }"
        class="absolute top-0 bottom-0 left-0 flex flex-col items-center w-64 h-full py-2 text-sm transition-all duration-200 transform bg-white dark:text-white dark:bg-gray-900">
        <div class="w-full px-3 mb-2">
            <svg :class="{'rotate-180': show }" class="w-6 h-6 text-gray-500 transition duration-200 transform"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        @foreach ($streams as $stream)
        <a href="{{ route('stream', ['stream' => $stream['user_name']]) }}"
            class="flex items-center w-full px-2 py-2 space-x-2 group hover:bg-gray-100 dark:hover:bg-black">
            <div class="flex-shrink-0 w-8 h-8 rounded-full group-hover:ring-4 ring-teal-500">
                <img class="object-cover w-full h-full rounded-full" src="{{ $stream['thumbnail_352'] }}"
                    alt="{{ $stream['title'] }}">
            </div>
            <div class="flex flex-col flex-grow overflow-hidden leading-4">
                <div class="font-bold truncate">{{ $stream['user_name'] }}</div>
                <div class="text-xs truncate">{{ $stream['game_name'] }}</div>
            </div>
            <div class="flex items-center justify-end flex-shrink-0 w-10">
                {{ $stream['viewer_count_formatted'] ?? $stream['viewer_count'] }}</div>
        </a>
        @endforeach
    </div>
</div>
@endif
