@extends('layouts.app',['title'=>'Pacient List'])

@section('content')
	<div class="container">
		<div class="panel panel-info " style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
			<div class="panel-heading">
				@can('pacient.create',Auth::user())
					<a href="{{url('/pacient/create')}}" class="btn btn-xs btn-default">Register New Pacient</a> | Pacient List
				@endcan
				<div class="pull-right">
					Total: <div class="badge">{{count($data)}}</div>
				</div>
			</div>
			<div class="table-responsive">

				<table class="table table-condensed table-hover table-striped">
					<thead>
					<tr>
						<th>Pacient ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Age / Sex</th>
						<th>Referred By</th>
						<th>Address</th>
						<th>Date</th>
						<th>Manipulation</th>
					</tr>
					</thead>
					<tbody>
					<!-- List of all pacientes-->
					@foreach($data as $row)
						<tr>
							<td>{{$row->pacient->id}}</td>
							<td>{{$row->pacient->name}}</td>
							<td>{{$row->pacient->phone}}</td>
							<td>{{$row->pacient->address}}</td>
							<td>{{ $row->pacient->age  }} Years/
								@if($row->pacient->gender == 1)
									{{'Male'}}
								@else
									{{'Female'}}
								@endif
							</td>
							<td>{{$row->pacient->doctor->name}}</td>
							<td>{{$row->pacient->address}}</td>
							<td>{{ \Carbon\Carbon::now()->diffForHumans() }}</td>

							<td>

								<div class="btn-group btn-group-xs" role="group">
									<form action="{{'/pacient/'.$row->id}}" method="post">
										{{csrf_field()}}
										{{method_field('delete')}}
										@can('pacient.update',Auth::user())
											<a class="btn btn-primary" href="{{'/pacient/'.$row->id.'/edit'}}">edit</a>
										@endcan
										@can('pacient.delete',Auth::user())
											<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete"/>
										@endcan
									</form>
								</div>

								<a class="btn btn-success" href="{{ route('save.result',$row->pacient->id) }}">Save Result</a>
							</td>
						</tr>
					@endforeach()
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop