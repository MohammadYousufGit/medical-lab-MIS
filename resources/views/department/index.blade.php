@extends('layouts.app',['title'=>'Department List'])

@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			<a href="{{ route('department.create') }}" class="btn btn-xs btn-default">Create New Department</a> | Departmentes List
			<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>

		<div class="table-responsive">
			
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>department ID</th>--}}
						<th>department Name</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all departmentes-->			
					@foreach($data as $row)
					<tr>
						<td>{{$row->name}}</td>
						<td>
							<form action="{{'/department/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">
									<a class="btn btn-primary" href="{{'/department/'.$row->id.'/edit'}}">edit</a>
									<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
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