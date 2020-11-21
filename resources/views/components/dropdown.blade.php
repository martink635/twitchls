@props(['items'])

<div x-data="{ open: false, selected: @entangle($filter), title: '', search: '' }"
    {{ $attributes->merge(['class' => 'relative']) }}>

    <div x-show="open" class="fixed inset-0 z-10 w-full h-screen bg-gray-500 opacity-25"></div>

    <div x-on:click.away="open = false" x-on:keydown.escape="open = false"
        class="relative z-40 transition duration-500 bg-white rounded-t-lg">
        <div x-on:click="open = true; $nextTick(() => { $refs.search.focus() });"
            class="flex justify-between px-4 py-4 text-gray-500 cursor-pointer">
            <input x-show="open" x-model="search" x-ref="search" type="text" class="w-full outline-none" />

            <div x-show="!open" class="flex justify-between w-full cursor-pointer">
                <span x-text="selected"></span>
                <span x-show="selected !== null" x-text="title"></span>
                <span x-show="selected === null">Type your favorite game here</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.9999 15.4999C11.8683 15.5007 11.7379 15.4755 11.616 15.4257C11.4942 15.3759 11.3834 15.3026 11.2899 15.2099L7.28994 11.2099C7.1967 11.1167 7.12274 11.006 7.07228 10.8842C7.02182 10.7624 6.99585 10.6318 6.99585 10.4999C6.99585 10.3681 7.02182 10.2375 7.07228 10.1157C7.12274 9.99387 7.1967 9.88318 7.28994 9.78994C7.38318 9.6967 7.49387 9.62274 7.61569 9.57228C7.73751 9.52182 7.86808 9.49585 7.99994 9.49585C8.1318 9.49585 8.26237 9.52182 8.38419 9.57228C8.50601 9.62274 8.6167 9.6967 8.70994 9.78994L11.9999 13.0999L15.2999 9.91994C15.3919 9.81765 15.504 9.73544 15.6293 9.67846C15.7545 9.62147 15.8901 9.59093 16.0276 9.58875C16.1652 9.58657 16.3017 9.6128 16.4287 9.66579C16.5556 9.71878 16.6703 9.7974 16.7655 9.89672C16.8607 9.99605 16.9343 10.1139 16.9819 10.243C17.0294 10.3721 17.0498 10.5096 17.0418 10.647C17.0338 10.7843 16.9975 10.9185 16.9352 11.0412C16.873 11.1639 16.7861 11.2724 16.6799 11.3599L12.6799 15.2199C12.4971 15.3963 12.2539 15.4964 11.9999 15.4999Z" />
                </svg>
            </div>
        </div>

        <div x-show="open"
            class="absolute left-0 right-0 z-10 w-full pt-6 origin-top-right bg-white rounded-b-lg shadow-xs shadow-lg ">
            <div class="flex flex-wrap px-4 pb-4 space-y-4 overflow-y-scroll text-sm font-bold"
                style="max-height: 256px;">
                @foreach ($items as $item)
                <div x-show="'{{ str_replace("'", "", $item['name']) }}'.toLowerCase().startsWith(search.toLowerCase())"
                    x-on:click="selected = {{ $item['id'] }}; open = false; title = '{{ $item['name'] }}';"
                    class="flex items-center justify-between w-full cursor-pointer group"
                    :class="{ 'text-teal-500' : selected === {{ $item['id'] }}}">
                    <x-secondary>{{ $item['name'] }}</x-secondary>
                    <span class="italic font-light">5000</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
