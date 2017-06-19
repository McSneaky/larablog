@extends('layouts.app')

@section('content')


<div class="container">
    <div class="text-center">
        <h2>@lang('app.all_posts')</h2>
    </div>
    <div id="posts" class="list-group">
        @foreach ($posts as $post)
            @if($loop->iteration % 3 == 0)
                <div class="row">
            @endif
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4>{{ $post->title }}</h4>
                                <p>
                                    <?php
                                    echo (strlen($post->body) > 100) ? substr($post->body,0,100).'...' : $post->body; 
                                    ?>
                                </p>
                                <div class="row top-buffer">
                                    <div class="col-md-6">
                                        <a class="btn btn-primary" href="{{ route('post_show', $post->id) }}">@lang('app.open_post')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @if($loop->iteration % 3 == 0)
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-xs-12">
            {{ $posts->links() }}
        </div>
    </div>
    @endsection
