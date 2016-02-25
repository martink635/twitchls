@extends('layout')

@section('title', 'About')

@section('content')
    <div class="container">

        <div class="row page">
            <div class="col-md-6 col-md-offset-3">

                @if (isset($user))
                <p>
                    <div class="alert alert-warning">
                        <h4>You are logged in via Twitch.</h4>
                        <p>We do not store your Twitch information.</p>
                        <p></p>
                        <p>If you would like to remove the Twitch connection for this website, click <i>Disconnect</i> for <i>twitchls</i> <a href="http://www.twitch.tv/settings/connections">here</a>.</p>
                    </div>
                </p>
                @endif

                <p>
                    <div class="alert alert-info">
                        <h4>Experimental HTML5 playback is <b>{{ \Session::get('html5') ? 'on' : 'off' }}</b>.</h4>
                        <p>This has been tested on the latest Chrome and Firefox.</p>
                        <p>It doesn't turn off HTML5 streaming on HLS enabled browsers.</p>
                        <p><a href="/html5" class="btn btn-primary">{{ \Session::get('html5') ? 'Disable' : 'Enable' }}</a></p>
                    </div>
                </p>

                <h1>About</h1>

                <p>This is an open source project, enabling you to watch streams using <a href="http://en.wikipedia.org/wiki/HTTP_Live_Streaming">HLS</a> techonolgy instead of Flash. It uses significantly less power on a Mac. It also has the option to display the Twitch chat, which thanks to the new Twitch update also loads without using Flash.</p>

                <p>HLS works only on a handful of browsers:</p>
                <ul>
                    <li>Safari 6+ (5+ for iOS),</li>
                    <li>Edge (on Windows 10),</li>
                    <li>Chrome for Android 30+,</li>
                    <li>Stock Android browser 4.1+.</li>
                </ul>

                <h2>Update: 25 February 2016</h2>

                <p>There is a <a href="https://github.com/mkoterle/twitchls/issues/1">new undocumented feature</a> that allows you to watch streams using HTML5 without using an HLS compatible browser listed above. It is enabled by default. If you are having problems with it you can disable it by <a href="/html5">clicking here</a>.</p>

                <p>Twitchls is open source, licensed under <a href="http://opensource.org/licenses/mit-license.html">MIT License</a>, available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</p>

            </div>
        </div>

    </div>
@endsection
