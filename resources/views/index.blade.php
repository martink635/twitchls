<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        @if (isset($user))
        <meta name="identifier" content="{{ $user->identifier }}">
        @endif

        <meta name="description" content="Watch your favorite Twitch streams using HTML5/HLS technology instead of Flash with chat.">

        <title>Twitchls</title>

        <link rel="stylesheet" href="/css/app.css">

    </head>

    <body>

        <app></app>

        <footer class="text-muted">
            <div class="container">
                <p><a href="/"><span class="logo">twitc<span class="logo__hls">hls</span></span></a> <small>Watch Twitch HTML5 streams with chat. Available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</small></p>
            </div>
        </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>

    @include('analytics')
    </body>
</html>
