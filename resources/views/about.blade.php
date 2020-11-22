@extends('layouts.default')

@section('content')
<div class="max-w-2xl">

    <x-title>About</x-title>

    <p>This website started as an alternative way to watch <x-link href="https://twitch.tv" rel="nofollow"
            target="_blank">Twitch.tv</x-link> with HLS playback enabled with chat in the sidebar. At that point (2015)
        this
        was not available on the official page by default and it was the best way to watch streams on macOS Safari. As
        of right now this is all enabled on the official <x-link href="https://twitch.tv" rel="nofollow"
            target="_blank">Twitch.tv</x-link> page as well.</p>

    <h2 class="mt-12 mb-3 text-lg font-bold sm:text-2xl">So, why does this website still exist?</h2>
    <p>Over the years hundreds of thousands of unique users have used this to watch <x-link href="https://twitch.tv"
            rel="nofollow" target="_blank">Twitch.tv</x-link> streams. As long as users will watch streams using this
        service it will
        be
        online. After the recent (2020) <x-link href="https://twitch.tv" rel="nofollow" target="_blank">Twitch.tv
        </x-link> changes the userbase keeps
        growing.
    </p>

    <h2 class="mt-12 mb-3 text-lg font-bold sm:text-2xl">"I would like this missing feature!"</h2>
    <p>The goal of this project is to keep the watching experience as fast and as light as possible. This also means
        only a handful of features are available and implemented. This project is completely open-source and available
        on <x-link href="https://github.com/martink635/twitchls" rel="nofollow" target="_blank">Github</x-link>. Feel
        free to
        submit
        issues with feature requests and bugs on <x-link href="https://github.com/martink635/twitchls" rel="nofollow"
            target="_blank">Github</x-link>, but keep in
        mind,
        not everything will be made.</p>

    <h2 class="mt-12 mb-3 text-lg font-bold sm:text-2xl">How to dark mode?</h2>
    <p>It's currently toggled automatically if your system is set to dark mode.</p>

    <h2 class="mt-12 mb-3 text-lg font-bold sm:text-2xl">Supporting this project</h2>
    <p>We receive messages regarding how to support this project. We are not taking donations, and this site is
        inexpensive to run. But if you are looking for web/app design/development, feel free to use the links in the
        footer to get in touch.</p>
</div>
@endsection
