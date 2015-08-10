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
        @if (! isset($user))
        <li><a class="btn" href="/login">Login with Twitch</a></li>
        @else
        <li><a href="/logout">Logout {{ $user->display_name }}</a></li>
        @endif
        <li><a href="/about">About</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
