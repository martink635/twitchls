<div>

    <div class="flex flex-wrap items-center justify-between md:flex-no-wrap">

        <nav
            class="flex flex-col flex-wrap space-y-2 text-sm font-bold md:space-y-0 md:flex-row md:items-center md:space-x-8 lg:w-2/3">
            @auth
            <x-secondary wire:click="filterBy('followed')" class="{{ $filter === 'followed' ? 'text-teal-500': '' }}">
                Followed
            </x-secondary>
            @endauth

            <x-secondary wire:click="filterBy(null)" class="{{ is_null($filter) ? 'text-teal-500': '' }}">All
            </x-secondary>

            @foreach (array_slice($games, 0, 3) as $game)
            <x-secondary wire:click="filterBy('{{ $game['id'] }}')"
                class="{{ $filter === $game['id'] ? 'text-teal-500': '' }}">{{ $game['name'] }}</x-secondary>
            @endforeach
        </nav>

        {{--
        <x-dropdown :items="$games" class="lg:w-1/3" /> --}}
        <div x-data="{ open: false }" class="w-full mt-4 lg:mt-0 lg:w-1/3">

            <div x-show="open" class="fixed inset-0 z-10 w-full h-screen bg-gray-500 opacity-25"></div>

            <div x-on:click.away="open = false" x-on:keydown.escape="open = false"
                class="relative z-40 transition duration-500 bg-white rounded-t-lg dark:bg-black">
                <div x-on:click="open = true; $nextTick(() => { $refs.search.focus() });"
                    class="flex justify-between px-4 py-4 text-gray-500 cursor-pointer">
                    <input x-show="open" x-ref="search" wire:model="query" type="text"
                        class="w-full bg-white outline-none dark:bg-black" wire:keydown.arrow-up="decrementHighlight"
                        wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="filterByHighlight"
                        x-on:keydown.enter="open = false" x-on:keydown.tab="open = false"
                        x-on:keydown.escape="open = false" />

                    <div x-show="!open" class="flex justify-between w-full cursor-pointer">
                        @if ($filter && $filter !== 'followed')
                        <span class="truncate">{{ $this->filterName }}</span>
                        @else
                        <span>Filter by game</span>
                        @endif
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.9999 15.4999C11.8683 15.5007 11.7379 15.4755 11.616 15.4257C11.4942 15.3759 11.3834 15.3026 11.2899 15.2099L7.28994 11.2099C7.1967 11.1167 7.12274 11.006 7.07228 10.8842C7.02182 10.7624 6.99585 10.6318 6.99585 10.4999C6.99585 10.3681 7.02182 10.2375 7.07228 10.1157C7.12274 9.99387 7.1967 9.88318 7.28994 9.78994C7.38318 9.6967 7.49387 9.62274 7.61569 9.57228C7.73751 9.52182 7.86808 9.49585 7.99994 9.49585C8.1318 9.49585 8.26237 9.52182 8.38419 9.57228C8.50601 9.62274 8.6167 9.6967 8.70994 9.78994L11.9999 13.0999L15.2999 9.91994C15.3919 9.81765 15.504 9.73544 15.6293 9.67846C15.7545 9.62147 15.8901 9.59093 16.0276 9.58875C16.1652 9.58657 16.3017 9.6128 16.4287 9.66579C16.5556 9.71878 16.6703 9.7974 16.7655 9.89672C16.8607 9.99605 16.9343 10.1139 16.9819 10.243C17.0294 10.3721 17.0498 10.5096 17.0418 10.647C17.0338 10.7843 16.9975 10.9185 16.9352 11.0412C16.873 11.1639 16.7861 11.2724 16.6799 11.3599L12.6799 15.2199C12.4971 15.3963 12.2539 15.4964 11.9999 15.4999Z" />
                        </svg>
                    </div>
                </div>

                <div x-show="open"
                    class="absolute left-0 right-0 z-10 w-full pt-6 origin-top-right bg-white rounded-b-lg shadow-xs shadow-lg dark:bg-black">
                    <div class="flex flex-wrap px-4 pb-4 space-y-4 overflow-y-scroll text-sm font-bold"
                        style="max-height: 256px;">
                        @foreach ($filteredGames as $item)
                        <div wire:click="filterBy('{{ $item['id'] }}')" x-on:click="open = false"
                            class="flex space-x-4 w-full items-center justify-between cursor-pointer group {{ $highlightIndex === $loop->index ? 'text-teal-500': '' }}">
                            <div class="flex flex-grow space-x-2 truncate">
                                <x-secondary class="truncate">{{ $item['name'] }}</x-secondary>
                                @if ($filter === $item['id'])
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3 sm:gap-8 sm:mt-10">

        @foreach ($streams as $stream)
        <a href="{{ route('stream', ['stream' => $stream['user_name']]) }}"
            class="relative flex flex-col justify-end overflow-hidden duration-150 rounded-lg cursor-pointer ransition group"
            title="{{ $stream['title'] }}">
            <img class="w-full" src="{{ $stream['thumbnail_480'] }}"
                alt="{{ $stream['user_name'] }} streaming {{ $stream['game_name'] }}">

            <div
                class="absolute bottom-0 left-0 right-0 w-full px-4 pt-2 pb-2 mb-2 text-white bg-black dark:bg-gray-900">
                <div class="text-lg font-bold leading-7 text-white truncate">{{ $stream['title'] }}</div>
                <div class="mt-1 text-sm italic leading-6 tracking-wide text-teal-100">
                    {{ number_format($stream['viewer_count']) }} on {{ $stream['user_name'] }}</div>
            </div>

            <div class="w-full h-12 bg-teal-500"></div>
            <div class="absolute bottom-0 z-10 w-0 h-2 transition-all duration-200 bg-teal-200 group-hover:w-full">
            </div>

        </a>
        @endforeach

    </div>

    @if ($next)
    <div class="flex mt-10 sm:mt-16">
        <span wire:click="loadMore('{{ $cursor }}')">
            <x-primary class="text-lg">Load more</x-primary>
        </span>
    </div>
    @endif
</div>