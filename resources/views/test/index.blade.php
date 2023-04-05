@extends('layouts.app',['title'=>'test List'])

@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			<a href="{{url('/test/create')}}" class="btn btn-xs btn-default">Create New test</a> | Test List
			<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>

		<div class="table-responsive">
			
			<table class="table table-condensed table-hover table-striped " id="example1">
				<thead>
					<tr>
						{{-- <th>test ID</th>--}}
						<th>Name</th>
						<th>Code</th>
						<th>Fee</th>
						<th>Comment</th>
						<th>Department</th>
						<th>Parameters</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all testes-->			
					@foreach($data as $row)
					<tr class="@if($row->testparameter->count()==0) danger @endif">
						<td>{{$row->name}}</td>
						<td>{{$row->code}}</td>
						<td>{{$row->fee}}{{'/AFN'}}</td>
						<td>{{str_limit($row->comment,100)}}</td>
						<td>{{$row->department->name}}</td>
						<td>{{$row->testparameter->count()}}</td>
						<td>
							<form action="{{'/test/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">

									<a class="btn btn-primary" href="{{'/test/'.$row->id.'/edit'}}">edit</a>
									@can('test.delete',Auth::user())

									<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
									@endcan
{{--									@can('parameter.view',Auth::user())--}}

									<a class="btn btn-success" href="{{'/test/'.$row->id}}">View Parameters</a>
									{{--@endcan--}}
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