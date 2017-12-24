@extends('layouts.parent')

@section('content')
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
@endsection