@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit post: {{ $post->title }}</div>

                <div class="panel-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <div>Title</div>
                        <input type="text" name="title" value="{{ $post->title }}" placeholder="Title" class="form-control">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <br />
                        <div>Body</div>
                        <textarea name="body" placeholder="Post content" class="form-control">{{ $post->body }}</textarea>
                        @foreach($post->images as $image)
                            <div class="col-sm-4">
                                <img class="col-xs-12" src="{{ Storage::url($image->path) }}">
                                <a href="{{ url('image/delete/' . $image->id) }}" class="rem-image btn btn-danger">x</a>
                            </div>
                        @endforeach
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                        <div class="col-sm-12">
                            <input type="submit" value="Post" class="btn btn-primary">
                            <a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger pull-right">Delete post</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
