<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediaCollector</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<header>
    <nav class="navbar fixed-top navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/twitter') }}">MediaCollector</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="line-height:2">
                <li class=@if (isset($filter) && $filter === 'media') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/twitter') }}">通常検索<span class="sr-only">(current)</span></a>
                </li>
                <li class=@if (isset($filter) && $filter === 'images') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/twitter') . '?filter=images' }}">画像検索<span class="sr-only">(current)</span></a>
                </li>
                <li class=@if (isset($filter) && $filter === 'videos') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/twitter') . '?filter=videos' }}">動画検索<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <span class="navbar-text" style="line-height:2">@if (isset($word)) {{ $word }} @endif</span>
            <form class="form-inline my-2 my-lg-0" method="get" action="twitter">
                <input type="hidden" name="filter" value="{{ request('filter', 'media') }}">
                <input class="form-control mr-sm-2" type="text" name="word" placeholder="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a class="btn btn-outline-primary btn-sm" href="/oauth/request" role="button">ログイン</a>
            <a class="btn btn-outline-danger btn-sm" href="/logout" role="button">ログアウト</a>


        </div>
    </nav>
</header>
<body class="bg-inverse">
<div class="container" style="padding-top: 70px;">
    @yield('content')
</div>
</body>
</html>
