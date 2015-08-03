<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Watch your favorite Twitch streams using HTML5/HLS technology instead of Flash with chat.">

        <title>@yield('title') - twitchls</title>

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">

        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>

        <div id="no-hls-alert" class="alert alert-warning text-center hidden">You are not using an <b>HLS</b> compatible browser. Streams will load using Flash instead of HTML5. Please check out <a href="/about">/about</a> for more information.</div>

        @yield('content')

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><a href="/"><span class="logo">twitc<span class="blue">hls</span></span></a> <small>Watch Twitch HTML5 streams with chat. Available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</small></h2>

                    </div>
                </div>
            </div>
        </footer>

        <script src="/js/app.js"></script>

        @include('analytics')
    </body>
</html>
