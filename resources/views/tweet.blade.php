<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MediaCollector</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

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

    </head>
    <body class="bg-inverse">
    <div class="container" style="padding-top: 70px;">
            @foreach($tweets as $tweet)
            @if ($loop->index % 2 == 0)
                @php $bg_color = '#4168c0' @endphp
            @else
                @php $bg_color = '#f7f7f7' @endphp
            @endif
                <ul class="list-unstyled" style="background-color:{{$bg_color}}">
                    <li class="media">
                        <img class="rounded-circle d-flex mr-3" src={{ $tweet->user->profile_image_url_https }} alt="Generic placeholder image">
                        <div class="media-body text-dark">
                            <h5 class="mt-0 mb-1">{{$tweet->user->name}} {{ $tweet->user->screen_name }}</h5>
                            {{ $tweet->text }}
                            <br />
                            {{--extended_entities--}}
                            @if (isset($tweet->extended_entities->media))
                                @foreach($tweet->extended_entities->media as $media)
                                    @if ($media->type === 'photo')
                                        <img class="img-thumbnail w-25 p-1" src={{ $media->media_url_https }} alt="Generic placeholder image">
                                    @elseif ($media->type === 'video')
                                        @if (isset($media->video_info->variants))
                                            <video class="img-thumbnail" src="{{ $media->video_info->variants[0]->url }}" controls loop preload="metadata"></video>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </body>
</html>
