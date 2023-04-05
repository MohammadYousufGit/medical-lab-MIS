@extends('layouts.app',['title'=>'Parameter List'])

@section('content')
<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			<a href="{{url('/parameter/create')}}" class="btn btn-xs btn-default">Add New Parameter</a> | Parameteres List of<strong> {{$test->name}}</strong>
			|  <a href="{{url('/test/')}}" class="btn btn-xs btn-warning">Go Back</a>
			<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>parameter ID</th>--}}
						<th>Parameter Name</th>
						<th>Belongs To</th>
						<th>Normal Range</th>
						<th>Unit</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all parameteres-->			
					@foreach($data as $row)
					<tr>
						<td>{{$row->name}}</td>
						<td>{{$row->test->name}}</td>
						<td>{{$row->normal}}</td>
						<td>{{$row->unit}}</td>
						<td>
							<form action="{{'/parameter/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">
									<a class="btn btn-primary" href="{{'/parameter/'.$row->id.'/edit'}}">edit</a>
									<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
								</div>
							</form>
						</td>
					</tr>
					@endforeach()
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop