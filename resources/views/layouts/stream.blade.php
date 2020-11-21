<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $stream }} - Twitchls</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="dark:bg-black">

    @yield('content')

</body>
</html>
