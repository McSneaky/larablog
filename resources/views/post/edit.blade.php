@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.edit_post') {{ $post->title }}</div>

                <div class="panel-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <div>@lang('app.title')</div>
                        <input type="text" name="title" value="{{ $post->title }}" placeholder="@lang('app.title')" class="form-control">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                        <br />
                        <div>@lang('app.body')</div>
                        <textarea name="body" placeholder="@lang('app.post_body')" class="form-control">{{ $post->body }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                        
                        @foreach($post->images as $image)
                            <div class="col-sm-4">
                                <img class="col-xs-12" src="{{ Storage::url($image->path) }}">
                                <a href="{{ url('image/delete/' . $image->id) }}" class="rem-image btn btn-danger">x</a>
                            </div>
                        @endforeach

                        <div class="col-sm-12">
                            <input type="submit" value="@lang('app.do_post')" class="btn btn-primary">
                            <a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger pull-right">@lang('app.delete')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
