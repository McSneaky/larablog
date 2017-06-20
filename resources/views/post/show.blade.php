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
					@foreach($post->images as $image)
						<div class="col-sm-4">
							<a href="{{ Storage::url($image->path) }}">
								<img class="col-xs-12" src="{{ Storage::url($image->path) }}">
							</a>
						</div>
					@endforeach
					@if((Auth::id() == $post->user_id) || Auth::user()->canModerate())
						<div class="col-md-12">
							<a href="{{ route('post_edit', $post->id) }}" class="btn btn-warning">@lang('app.edit')</a>
							<a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger pull-right">@lang('app.delete')</a>
						</div>
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
					@lang('app.comments')
				</div>
				<div class="panel-body">
					<form method="post" action="{{ url('/comment/' . $post->id) }}">
						{{ csrf_field() }}
						<input type="text" name="comment" required placeholder="@lang('app.comment')" class="form-control">
							@if ($errors->has('comment'))
								<span class="help-block">
									<strong>{{ $errors->first('comment') }}</strong>
								</span>
							@endif
						<input type="submit" class="btn btn-primary" value="@lang('app.comment')">
					</form>
				</div>
				@foreach($post->comments as $comment)
					<hr />
					<div class="panel-body">
						@if($comment->user)
							<strong>{{ $comment->user->name }}</strong>
						@else
							<strong>@lang('app.anon')</strong>
						@endif
						<div>{{ $comment->body }}</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
