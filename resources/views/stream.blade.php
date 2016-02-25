<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="{{ $stream->channel->status }} on {{ $stream->channel->name }} playing {{ $stream->game }}.">

        <title>{{ $stream->channel->status or 'Untitled Broadcast' }} on {{ $stream->channel->name }} - twitchls</title>

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">

        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body style="overflow:hidden">

        <div class="btn-group stream-buttons" role="group">
            <button class="btn btn-default" type="button" id="hide-chat" title="Show/Hide Twitch chat"><span class="glyphicon glyphicon-indent-left"></span></button>

            <button class="btn btn-default" type="button" id="fullscreen" title="Toggle FullScreen"><span class="glyphicon glyphicon-resize-full"></span></button>
        </div>

        <div class="container-fluid">
            <div class="row no-padding">
                <div class="stream col-md-9" id="stream">
                    <iframe
                        src="http://player.twitch.tv/?channel={{ $stream->channel->name }}&autoplay=true{{ \Session::get('html5') ? '&html5=true ' : '' }}"
                        frameborder="0"
                        scrolling="no"
                        allowfullscreen="no">
                    </iframe>
                    <iframe frameborder="0" scrolling="no" src="http://www.twitch.tv//embed"></iframe>
                </div>

                <div class="chat col-md-3" id="chat">
                    <iframe frameborder="0" scrolling="no" id="twitch_embed_chat" class="side" src="http://www.twitch.tv/{{ $stream->channel->name }}/chat?popout" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <script src="/js/stream.js"></script>

        @include('analytics')
    </body>
</html>
