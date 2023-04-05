@extends('layouts.app',['title'=>'doctor List'])

@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			<a href="{{ route('doctor.create') }}" class="btn btn-xs btn-default">Create New Doctor</a> | Doctores List
			<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>

		<div class="table-responsive">
			
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>doctor ID</th>--}}
						<th>Doctor Name</th>
						<th>Contact Info</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all doctores-->			
					@foreach($data as $row)
					<tr>
						<td>{{$row->name}}</td>
						<td>{{$row->phone}}</td>
						<td>
							<form action="{{'/doctor/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">

									@can('doctor.update',Auth::user())
									<a class="btn btn-primary" href="{{route('doctor.edit',$row->id)}}">edit</a>
									@endcan
										@can('doctor.delete',Auth::user())
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
		<div class="panel-footer">
			{!!$data->links();!!}	
		</div>
	</div>
</div>
@stop