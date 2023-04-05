@extends('layouts.app',['title'=>'pacienttest List'])

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Pacient Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Gender</th>
						<th>Age</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$pacient->name}}</td>
						<td>{{$pacient->phone}}</td>
						<td>{{$pacient->address}}</td>
						<td>
							@if($pacient->gender == 1)
							{{'Male'}}
							@else
								{{'Female'}}
							@endif
						</td>
						<td>{{$pacient->age}}</td>
					</tr>
				</tbody>
			</table>
		</div>		
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			| pacienttest List
			<div class="pull-right">
				Test Added: <div class="badge">{{count($testadded)}}</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Test Name</th>
						<th>Code</th>
						<th>Fee</th>
						<th>Department</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all pacienttestes-->			
					@foreach($testadded as $row)
					<tr>
						<td>{{$row->test->name}}</td>
						<td>{{$row->test->code}}</td>
						<td>{{$row->test->fee}}{{'/AFN'}}</td>
						<td>{{$row->test->department->name}}</td>
						<td>
							<form action="{{'/pacienttest/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">
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
	<div class="panel panel-info">
		<div class="panel-heading" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
			Test List
			<div class="pull-right">
				
			</div>
		</div>
		<form action="{{ route('pacienttest.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
			<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped dataTable">
				<thead>
					<tr>
						<th>Test Name</th>
						<th>Code</th>
						<th>Fee</th>
						<th>Department</th>
						<th>Add</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all pacienttestes-->
					@if(count($test)>0)			
					@foreach($test as $row)
					<tr>
						<td>{{$row->name}}</td>
						<td>{{$row->code}}</td>
						<td>{{$row->fee}}{{'/AFN'}}</td>
						<td>{{$row->department->name}}</td>
						<td>
			                 <input id="name" type="checkbox" name="test[]" value="{{$row->id}}"  />
			                 <input type="hidden" name="pacient" value="{{$pacient->id}}">
						</td>
					</tr>
					@endforeach()
					@else
					{{'All Tests has been add for Pacient'}}
					@endif
				</tbody>
			</table>
		</div>
		<!--End of table div  -->
	         
	   		</div>
			<div class="panel-footer">	
			<div class="form-group">
	            <input type="submit" class="btn btn-primary" value="Add to Bill">
	        </div>

			</div>
		</form>

		
	</div>
</div>
@stop