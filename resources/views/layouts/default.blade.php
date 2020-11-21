<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Twitchls - alternative twitch.tv listing</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="">

    <div class="w-full h-1 bg-teal-500"></div>

    <header class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row justify-between py-10">
        <a href="{{ route('home') }}">
            <x-logo /></a>

        <div class="flex space-x-4 mt-4 sm:mt-0">
            <x-link href="{{ route('about') }}">About</x-link>
            @guest
            <x-link>Log In with Twitch.tv</x-link>
            {{-- <a href="{{ route('login.twitch') }}" class="text-indigo-600 hover:text-indigo-800
            hover:underline">Login using Twitch</a> --}}
            @endguest

            @auth
            <x-link>Log out</x-link>
            @endauth
        </div>

    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6">
        @yield('content')
    </main>

    <footer
        class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col space-y-4 sm:space-y-0 sm:flex-row justify-between mt-16 sm:mt-32 mb-8 sm:mb-16 text-gray-500 text-sm">
        <a href="{{ route('home') }}">
            <x-logo /></a>
        <span>Alternative Twitch.tv listing with chat. Available on <a
                class="underline hover:text-teal-900 transition duration-150"
                href="https://github.com/martink635/twitchls" rel="nofollow" target="_blank">Github</a>.</span>
        <span>Designed with <span class="text-red-500">♥</span> by <a href="https://urska.design"
                class="underline hover:text-teal-900 transition duration-150" target="_blank">urska.design</a></span>
    </footer>

    @livewireScripts
</body>

</html>
