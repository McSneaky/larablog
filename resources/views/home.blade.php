@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">@lang('app.dashboard')</div>
				<div class="panel-body">
					@lang('app.login_message')

					@if(Auth::user()->isAdmin())
						<hr />
						<h4 class="col-sm-12">@lang('app.manage_users'):</h4>
						<div class="table">
							<div class="row col-sm-12">
								<div class="col-xs-3">@lang('auth.name')</div>
								<div class="col-xs-4">@lang('auth.email')</div>
								<div class="col-xs-2">@lang('app.role')</div>
								<div class="col-xs-3">@lang('app.edit_delete')</div>
							</div>
							@foreach($users as $user)
								<form method="post" action="{{ route('user_edit', $user->id) }}">
									{{ csrf_field() }}
									<div class="row col-xs-12">
										<div class="col-xs-3">
											<input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
										</div>
										<div class="col-xs-4">
											<input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
										</div>
										<div class="col-xs-2">
											<select name="role" class="form-control">
											<option value="">-</option>
												@foreach($roles as $role)
													<option value="{{ $role->id }}"
													@if($user->role && $user->role->id == $role->id)
														selected
													@endif>
														{{ $role->name }}
													</option>
												@endforeach
											</select>
										</div>
										<div class="col-xs-3">
											<input type="submit" value="@lang('app.save')" class="btn btn-warning">
											<a href="{{ route('user_delete', $user->id) }}" class="btn btn-danger">@lang('app.delete')</a>
										</div>
									</div>
								</form>
							@endforeach
						</div>
						{{ $users->links() }}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
