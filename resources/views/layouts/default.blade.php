<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Twitchls - Alternative Twitch.tv listing</title>

    <!-- Primary Meta Tags -->
    <title>Twitchls - Alternative Twitch.tv listing</title>
    <meta name="title" content="Twitchls - Alternative Twitch.tv listing">
    <meta name="description" content="">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://twitchls.com/">
    <meta property="og:title" content="Twitchls - Alternative Twitch.tv listing">
    <meta property="og:description" content="">
    <meta property="og:image" content="https://twitchls.com/og.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://twitchls.com/">
    <meta property="twitter:title" content="Twitchls - Alternative Twitch.tv listing">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="https://twitchls.com/og.png">

    <link rel="icon" href="favicon.svg">
    <link rel="mask-icon" href="favicon-mask.svg" color="#38B2AC">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="font-sans antialiased text-black dark:bg-black dark:text-white">
    <div class="w-full h-1 bg-teal-500"></div>

    @if (env('APP_ENV') !== 'production')
        <div class="absolute left-0 right-0 flex justify-center w-full">
            <a href="{{ route('preview') }}"
                class="px-3 py-2 text-xs font-bold uppercase transition duration-100 bg-teal-500 rounded-b-lg hover:bg-teal-900">Preview
                version</a>
        </div>
    @endif

    <header class="flex flex-col justify-between max-w-6xl px-4 py-10 mx-auto sm:flex-row sm:px-6">
        <a href="{{ route('home') }}">
            <x-logo /></a>

        <div class="flex mt-4 space-x-4 sm:mt-0">
            <x-primary href="{{ route('about') }}">About</x-primary>
            @guest
                <x-primary href="{{ route('login') }}">Log In with Twitch.tv</x-primary>
            @endguest

            @auth
                <x-primary href="{{ route('settings') }}">Settings</x-primary>
                <x-primary href="{{ route('logout') }}">Log out</x-primary>
            @endauth
        </div>

    </header>

    <main class="max-w-6xl px-4 mx-auto sm:px-6">
        @yield('content')
    </main>

    <footer
        class="flex flex-col justify-between max-w-6xl px-4 mx-auto mt-16 mb-8 space-y-4 text-sm text-gray-500 sm:mb-16 sm:mt-32 sm:flex-row sm:space-y-0 sm:px-6">
        <a href="{{ route('home') }}">
            <x-logo /></a>
        <span>Alternative Twitch.tv listing with chat. Available on <x-link
                href="https://github.com/martink635/twitchls" rel="nofollow" target="_blank">Github</x-link>.</span>
        <span>Designed with <span class="text-red-500">♥</span> by <x-link href="https://urska.design" target="_blank">
                urska.design</x-link></span>
    </footer>

    @livewireScripts
</body>

</html>
