<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Twitchls - Alternative Twitch.tv listing</title>

    <link rel="icon" href="favicon.svg">
    <link rel="mask-icon" href="favicon-mask.svg" color="#38B2AC">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="font-sans antialiased text-black dark:bg-black dark:text-white">

    <div class="w-full h-1 bg-teal-500"></div>

    <header class="flex flex-col justify-between max-w-6xl px-4 py-10 mx-auto sm:px-6 sm:flex-row">
        <a href="{{ route('home') }}">
            <x-logo /></a>

        <div class="flex mt-4 space-x-4 sm:mt-0">
            <x-primary href="{{ route('about') }}">About</x-primary>
            @guest
            <x-primary href="{{ route('login') }}">Log In with Twitch.tv</x-primary>
            @endguest

            @auth
            <x-primary href="{{ route('logout') }}">Log out</x-primary>
            @endauth
        </div>

    </header>

    <main class="max-w-6xl px-4 mx-auto sm:px-6">
        @yield('content')
    </main>

    <footer
        class="flex flex-col justify-between max-w-6xl px-4 mx-auto mt-16 mb-8 space-y-4 text-sm text-gray-500 sm:px-6 sm:space-y-0 sm:flex-row sm:mt-32 sm:mb-16">
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
