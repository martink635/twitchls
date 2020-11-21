@extends('layouts.default')

@section('content')
<div class="max-w-2xl">

    <h1 class="text-2xl md:text-3xl lg:text-5xl font-semibold py-8 md:py-12">About</span></h1>

    <p>This website started as an alternative way to watch <a
            class="underline hover:text-teal-900 transition duration-150" href="https://twitch.tv" rel="nofollow"
            target="_blank">Twitch.tv</a> with HLS playback enabled with chat in the sidebar. At that point (2015) this
        was not available on the official page by default and it was the best way to watch streams on macOS Safari. As
        of right now this is all enabled on the official <a
            class="underline hover:text-teal-900 transition duration-150" href="https://twitch.tv" rel="nofollow"
            target="_blank">Twitch.tv</a> page as well.</p>

    <h2 class="text-lg sm:text-2xl font-bold mb-3 mt-12">So, why does this website still exist?</h2>
    <p>Over the years hundreds of thousands of unique users have used this to watch <a
            class="underline hover:text-teal-900 transition duration-150" href="https://twitch.tv" rel="nofollow"
            target="_blank">Twitch.tv</a> streams. As long as users will watch streams using this service it will be
        online. After the recent (2020) <a class="underline hover:text-teal-900 transition duration-150"
            href="https://twitch.tv" rel="nofollow" target="_blank">Twitch.tv</a> changes the userbase keeps growing.
    </p>

    <h2 class="text-lg sm:text-2xl font-bold mb-3 mt-12">"I would like this missing feature!"</h2>
    <p>The goal of this project is to keep the watching experience as fast and as light as possible. This also means
        only a handful of features are available and implemented. This project is completely open-source and available
        on <a class="underline hover:text-teal-900 transition duration-150"
            href="https://github.com/martink635/twitchls" rel="nofollow" target="_blank">Github</a>. Feel free to submit
        issues with feature requests and bugs on <a class="underline hover:text-teal-900 transition duration-150"
            href="https://github.com/martink635/twitchls" rel="nofollow" target="_blank">Github</a>, but keep in mind,
        not everything will be made.</p>

    <h2 class="text-lg sm:text-2xl font-bold mb-3 mt-12">How to dark mode?</h2>
    <p>It's currently toggled automatically if your system is set to dark mode.</p>

    <h2 class="text-lg sm:text-2xl font-bold mb-3 mt-12">Supporting this project</h2>
    <p>We receive messages regarding how to support this project. We are not taking donations, and this site is
        inexpensive to run. But if you are looking for web/app design/development, feel free to use the links in the
        footer to get in touch.</p>
</div>
@endsection
