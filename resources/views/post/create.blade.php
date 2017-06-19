@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">@lang('app.new_post')</div>
				@if ($errors->has('images.*'))
					<span class="help-block">
						<strong>{{ $errors->first('images.*') }}</strong>
					</span>
				@endif
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div>@lang('app.title')</div>
						<input type="text" name="title" placeholder="@lang('app.title')" required class="form-control">
						@if ($errors->has('title'))
							<span class="help-block">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
						@endif

						<br />
						<div>@lang('app.body')</div>
						<textarea name="body" placeholder="@lang('app.post_body')" class="form-control"></textarea>
						@if ($errors->has('body'))
							<span class="help-block">
								<strong>{{ $errors->first('body') }}</strong>
							</span>
						@endif
						
						<input type="file" name="images[]" multiple>
						<input type="submit" value="@lang('app.do_post')" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
