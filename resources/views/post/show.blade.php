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
                    <pre>{{ $post->body }}</pre>
                    @if(Auth::id() == $post->user_id)
                        <a href="{{ url('/post/edit/' . $post->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ url('/comment/' . $post->id) }}">
                        {{ csrf_field() }}
                        <input type="text" name="comment" required placeholder="Comment" class="form-control">
                        <input type="submit" class="btn btn-primary" value="Comment">
                    </form>
                </div>
                @foreach($post->comments as $comment)
                    <hr />
                    <div class="panel-body">
                        <strong>{{ $comment->user->name }}</strong>
                        <div>{{ $comment->body }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
