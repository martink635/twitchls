@extends('layout')

@section('title')
Stream list - twitchls
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
              <a class="navbar-brand" href="/">twitc<span class="logo-blue">h</span>ls</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              
              <ul class="nav navbar-nav navbar-right">
                <li><a href="/about">About</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

    <div class="container">

        <div class="row streams">
            @foreach ($streams as $stream)
                <a class="col-xs-12 col-sm-6 col-md-4 col-lg-3" href="/{{ $stream->channel->name }}" data-uk-filter="{{ $stream->game }}">
                    <img src="{{ $stream->preview->large }}" class="img-responsive" alt="">
                    <div class="caption">
                        <div class="stream-title">{{ $stream->channel->status or "Untitled Broadcast" }}</div>
                        <div class="stream-description">{!! number_format($stream->viewers) !!} on {{ $stream->channel->display_name or "" }}</div>
                    </div>
                </a>
            @endforeach            

        </div>

    </div>
@endsection