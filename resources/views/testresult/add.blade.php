@extends('layouts.app',['title'=>'Pacient List'])

@section('content')
<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">

		<div class="table-responsive">
			<div class="panel" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
				<table>
					<tr>
						<td><h2 style="color: #0b58a2;margin-right: 100px;margin-left: 10px">Add Test Result</h2></td>
						<td ><h3 style="margin-right: 70px !important;">Patient Name : {{ $pacient->name }}</h3></td>
						<td><h3>Patient Phone: 0{{ $pacient->phone }}</h3></td>
					</tr>

				</table>
			</div>
			<form role="form" action="{{ route('testresult.store') }}" method="post">
				{{ csrf_field() }}

			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Test Name</th>
						<th>Parameter Name</th>
						<th>Unit</th>
						<th>Normal Range</th>
						<th>Result</th>
					</tr>
				</thead>
				<tbody>

				
				<tbody>
					@foreach($parameters as $parameter)
					<tr>
						<td>{{ $parameter->test->name}}</td>
						<td>{{ $parameter->name}}</td>
						<td>{{ $parameter->unit}}</td>
						<td>{{ $parameter->normal}}</td>
						<td>
							<div class="form-group col-md-8">
								@php $ptIDs = \App\pacient_test::where('pacient_id',$pacient->id)->where('test_id',$parameter->test->id)->get();
								foreach($ptIDs as $ptID){
									$ptid = $ptID->id;
							}

								 @endphp
									
								<input type="hidden" class="form-control" id="name" name="pacienttest_id[]" placeholder="" value="{{ $ptid }}">

								<input type="text" class="form-control" id="name" name="testResult[]">
								<input type="hidden" class="form-control" id="name" name="parameter_id[]" value="{{ $parameter->id }}">
								
							</div>
					</tr>
					@endforeach
				</tbody>

			</table>
				<div class="form-group col-md-2">
					<a href="{{ route('print_bill',$pacient->id) }}" class="btn btn-default">Receipt</a>
					<input type="submit" class="btn btn-primary" style="float: right" value="save">

				</div>
			</form>
		</div>
	</div>
</div>
@stop