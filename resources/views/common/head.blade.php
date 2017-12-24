@section('header)
    <header>
        <nav class="navbar fixed-top navbar-toggleable-md navbar-light bg-faded">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/v1/twitter') }}">MediaCollector</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" style="line-height:2">
                    <li class=@if ($filter === 'media') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/v1/twitter') }}">通常検索<span class="sr-only">(current)</span></a>
                    </li>
                    <li class=@if ($filter === 'images') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/v1/twitter') . '?filter=images' }}">画像検索<span class="sr-only">(current)</span></a>
                    </li>
                    <li class=@if ($filter === 'videos') "nav-item active" @else "nav-item" @endif>
                    <a class="nav-link" href="{{ url('/v1/twitter') . '?filter=videos' }}">動画検索<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="navbar-text" style="line-height:2">{{ $word }}　 </span>
                <form class="form-inline my-2 my-lg-0" method="get" action="twitter">
                    <input type="hidden" name="filter" value="{{ request('filter', 'media') }}">
                    <input class="form-control mr-sm-2" type="text" name="word" placeholder="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
@endsection