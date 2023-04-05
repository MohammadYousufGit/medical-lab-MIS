@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Edit</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('user.update',$user->id) }}">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Name</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

									@if ($errors->has('name'))
										<span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

									@if ($errors->has('email'))
										<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							{{--for password manipulation--}}

							{{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
								{{--<label for="password" class="col-md-4 control-label">Password</label>--}}

								{{--<div class="col-md-6">--}}
									{{--<input id="password" type="password" class="form-control" name="password" required>--}}

									{{--@if ($errors->has('password'))--}}
										{{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
									{{--@endif--}}
								{{--</div>--}}
							{{--</div>--}}

							{{--<div class="form-group">--}}
								{{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

								{{--<div class="col-md-6">--}}
									{{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
								{{--</div>--}}
							{{--</div>--}}


							{{--soft code--}}
							<div class="form-group">
								<label for="name">Assign Roles</label>
								<div class="row">
									@foreach($roles as $role)
										<div class="col-lg-3">
											<div class="checkbox">
												<label for=""> <input type="checkbox"  name="role[]" value="{{ $role->id }}"
																	  @foreach($user->roles as $user_role)
																	  @if($user_role->id == $role->id)
																	  checked
															@endif
															@endforeach

													>{{ $role->name }}</label>
											</div>
										</div>
									@endforeach
								</div>

							</div>


							{{--hard code--}}


							<div class="box-body">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="{{ route('user.index') }}" class="btn btn-success">Go to Users</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
