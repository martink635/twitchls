@extends('layout')

@section('title')
{{ $stream->channel->status }} on {{ $stream->channel->name }} - twitchls
@endsection

@section('content')

        <button class="btn btn-default stream-button" type="button" id="hide-chat" title="Show/Hide Twitch chat"><span class="glyphicon glyphicon-indent-left"></span></button>

        <div class="container-fluid">
            <div class="row no-padding">
                <div class="stream col-md-9" id="stream">
                    <iframe frameborder="0" scrolling="no" src="http://www.twitch.tv/{{ $stream->channel->name }}/hls"></iframe>
                </div>

                <div class="chat col-md-3" id="chat">
                    <iframe frameborder="0" scrolling="no" id="twitch_embed_chat" class="side" src="http://twitch.tv/chat/embed?channel={{ $stream->channel->name }}&amp;popout_chat=true"></iframe>
                </div>
            </div>
        </div>
@endsection