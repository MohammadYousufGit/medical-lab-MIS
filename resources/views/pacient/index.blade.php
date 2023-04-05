@extends('layouts.app',['title'=>'Pacient List'])
@section('head')
	<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			@can('pacient.create',Auth::user())
			<a href="{{url('/pacient/create')}}" class="btn btn-xs btn-default">Register New Pacient</a> | Pacient List
			@endcan
				<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>
		<div class="table-responsive">

			<table id="example1" class="table table-bordered table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Pacient ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Age / Sex</th>
						<th>Referred By</th>
						<th>Branch</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all pacientes-->
					@foreach($data as $row)

					<tr>
						<td>{{$row->id}}</td>
						<td>{{$row->name}}</td>
						<td>0{{$row->phone}}</td>
						<td>{{$row->address}}</td>
						<td>
							@if($row->gender == 1)
								{{ $row->age }} years / {{'Male'}}
							@else
								{{ $row->age }} years / {{'Female'}}
							@endif
						</td>
						<td>{{$row->doctor->name}}</td>
						<td>{{$row->branch->name}}</td>
						<td>

											<a class="btn btn-success" href="{{route('save.result',$row->id)}}">Add Test Result</a>
											@can('pacient.update',Auth::user())
				<a class="btn btn-primary" href="{{ route('edit.pacient',$row->id) }}"><i class="glyphicon glyphicon-edit"></i> edit</a>
			@endcan

						</td>
					</tr>
					@endforeach()
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('script')
	<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
	</script>
@stop