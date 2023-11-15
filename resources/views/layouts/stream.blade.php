<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $stream }} - Twitchls</title>

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

</head>

<body class="font-sans antialiased dark:bg-black">

    @yield('content')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @livewireScripts
</body>

</html>
