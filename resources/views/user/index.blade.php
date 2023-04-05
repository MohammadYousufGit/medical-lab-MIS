@extends('layouts.app',['title'=>'Branch List'])

@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">

			<a href="{{ route('user.create') }}" class="btn btn-xs btn-default">
				@can('user.create' , Auth::user())
				Create New User
			@endcan
			</a> | Branches List

				<div class="pull-right">
				Total: <div class="badge">{{count($users)}}</div>
			</div>
		</div>

		<div class="table-responsive">
			
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>Branch ID</th>--}}
						<th>Users Name</th>
						<th>Users Email</th>
						<th>Assigned Branch</th>
						<th>Roles</th>

						<th>Manipulation</th>

					</tr>
				</thead>
				<tbody>
					<!-- List of all Branches-->			
					@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td></td>
						<td>
							@foreach($user->roles as $role)
								{{ $role->name }}&nbsp;
							@endforeach
						</td>
						<td>
							<form action="{{ route('user.destroy' , $user->id) }}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">
									@can('user.update', Auth::user())
									<a class="btn btn-primary" href="{{ route('user.edit' , $user->id ) }}">edit</a>
									@endcan
									@can('user.delete' , Auth::user())
										<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
									@endcan
								</div>
							</form>
						</td>
					</tr>
					@endforeach()
				</tbody>
			</table>
		</div>
		{{--<div class="panel-footer">--}}
			{{--{!!$users->links();!!}--}}
		{{--</div>--}}
	</div>
</div>
@stop