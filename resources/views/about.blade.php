@extends('layout')

@section('title')
About - twitchls
@endsection

@section('content')

    <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/"><span class="logo">twitc<span class="blue">hls</span></span></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              
              <ul class="nav navbar-nav navbar-right">
                <li><a href="/about">About</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                
                <h1>About</h1>

                <p>This is an open source project, enabling you to watch streams using the <a href="http://en.wikipedia.org/wiki/HTTP_Live_Streaming">HLS</a> techonolgy instead of Flash. It uses significantly less power on a Mac. It also has the option to display the Twitch chat, which does need Flash to load (the CPU usage for the Flash chat is insignificant compared to the video streaming).

                <p>HLS works only on a handful of browsers:
                <ul>
                    <li>Safari 6+ (5+ for iOS),</li>
                    <li>Chrome for Android 30+,</li>
                    <li>Stock Android browser 4.1+.</li>
                </ul>
                </p>

                <p>Twitchls is open source, licensed under <a href="http://opensource.org/licenses/mit-license.html">MIT License</a>, available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</p>

            </div>
        </div>

    </div>
@endsection