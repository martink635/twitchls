@extends('layout')

@section('title', 'About')

@section('content')
    <div class="container">

        <div class="row page">
            <div class="col-md-6 col-md-offset-3">

                @if (isset($user))
                <div class="alert alert-warning">
                    <h4>You are logged in via Twitch.</h4>
                    <p>We do not store your Twitch information.</p>
                    <p></p>
                    <p>If you would like to remove the Twitch connection for this website, click <i>Disconnect</i> for <i>twitchls</i> <a href="http://www.twitch.tv/settings/connections">here</a>.</p>
                </div>
                @endif

                <h1>About</h1>

                <p>This is an open source project, enabling you to watch streams using the <a href="http://en.wikipedia.org/wiki/HTTP_Live_Streaming">HLS</a> techonolgy instead of Flash. It uses significantly less power on a Mac. It also has the option to display the Twitch chat, which thanks to the new Twitch update also loads without using Flash.</p>

                <p>HLS works only on a handful of browsers:
                <ul>
                    <li>Safari 6+ (5+ for iOS),</li>
                    <li>Edge (on Windows 10),</li>
                    <li>Chrome for Android 30+,</li>
                    <li>Stock Android browser 4.1+.</li>
                </ul>
                </p>

                <p>If you are not using one of the browsers listed above, a notification will be shown on top of the site and the streams will load using Flash!</p>

                <p>Twitchls is open source, licensed under <a href="http://opensource.org/licenses/mit-license.html">MIT License</a>, available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</p>

            </div>
        </div>

    </div>
@endsection
