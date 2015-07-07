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

        <div class="row streams hidden">

            <form class="form-horizontal">
                <div class="form-group">
                    <select v-show="streams.length !== 0" class="col-xs-12 form-control" v-model="game">
                        <option value="" selected>All Games</option>
                        <option v-repeat="games" value="@{{ name }}">@{{ name }} (@{{ viewers }})</option>
                    </select>
                </div>
            </form>

            <a v-repeat="streams" class="col-xs-12 col-sm-6 col-md-4 col-lg-3" href="/@{{ channel }}">
                <img src="@{{ preview }}" class="img-responsive" alt="">
                <div class="caption">
                    <div class="stream-title">@{{ title }}</div>
                    <div class="stream-description">@{{ viewers }} on @{{ streamer }}</div>
                </div>
            </a>

            <div class="col-xs-12">
                <button v-show="! loading" v-on="click: loadMoreStreams" class="btn btn-default center-block">Load more streams</button>
                <img v-show="loading" class="center-block" src="/images/oval.svg">
            </div>
        </div>

    </div>
@endsection
