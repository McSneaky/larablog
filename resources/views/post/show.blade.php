@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $post->title }}
                </div>

                <div class="panel-body">
                    {{ $post->body }}
                </div>
                <button class="btn btn-primary">Comment</button>
                    @if(Auth::id() == $post->user_id)
                        <a href="{{ url('/post/edit/' . $post->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
