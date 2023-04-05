<html>
<head>

	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css" media="all" >
	<style type="text/css">
		td{
			padding-right: 75px;
		}
	</style>
	<style type="text/css" media="print">

		a{
			height: 100px;
			visibility: hidden;
		}

	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1" style="margin-top: 200px">

			<table class="table table-condensed table-hover table-striped dataTable">
				<tr>
					<th>Patient ID:</th><td><p>{{ $pacient->id }}</p></td><th>Printed By: </th><td><p>{{ Auth::user()->name }}</p></td>


				</tr>
				<tr>
					<th>Patient Name: </th><td><p>{{ $pacient->name }}</p></td><th>Print Date :</th><td><p>{{ $pacient->created_at }}</p></td>

				</tr>
				<tr>
					<th>Address : </th><td><p>{{ $pacient->address }}</p></td><th>Age / Sex: </th><td><p>{{ $pacient->age }} / @if($pacient->gender == 1)
								{{'Male'}}
							@else
								{{'Female'}}
							@endif</p></td>

				</tr>
				<tr>
					<th>Referred By: </th><td><p>@if($pacient->doctor->name == 'self')
								{{ $pacient->doctor->name }}
							@else  DR.{{ $pacient->doctor->name }} @endif</p></td><th>Phone:</th> <td><p>0{{ $pacient->phone }}</p></td>

				</tr>
				<tr>
					<th>Sample By:</th><td><p></p></td><th>Printing Date: </th><td><p>{{ \Carbon\Carbon::now()->toDateString() }}</p></td>
				</tr>


			</table>





		</div>

		<div class="col-md-10 col-md-offset-1">

			<table class="table table-condensed table-hover table-striped dataTable">
				<thead style="background-color: #00caff">
				<tr>
					<th>Department Name</th>
					<th>Test Name</th>
					<th>Parameter Name</th>
					<th>Result</th>
					<th>Unit</th>
					<th>Normal Range</th>

				</tr>
				</thead>
				@php $tests = array(); @endphp
				<tbody>@foreach($test as $row)


					<h3 style="text-align: center"></h3>
					<!-- List of all pacientes-->


						<tr>

							<td>{{ $row->department->name }}</td>
							<td>{{ $row->name }}</td>

						</tr>

					@php
						array_push( $tests,$row->fee) ;

					@endphp
				@endforeach
				@php
					$fee = 0;
                    for ($counter= 0 ; $counter<count($tests);$counter++){
                            $fee = $tests[$counter]+$fee;
                            //echo $tests[$counter];

                    }

				@endphp
				<br>
				</tbody>
			</table>

			<div class="col-md-4 " style="float: right">
				<table class="table table-condensed table-hover table-border table-striped dataTable">
					<tr><th>Grant Total : </th><td>{{ $fee }}</td></tr>
					<tr><th>Discount</th><td>{{ $pacient->discount }}</td></tr>
					<tr><th>Total To Pay</th><td>{{ $pacient->total_amount }}</td></tr>
					<tr><th>Remainig Amount</th><td>{{ $pacient->remained_amount }}</td></tr>

				</table>
			</div>

			<div class="col-md-6" style="margin-top: 100px;">
				@can('pacient.update',Auth::user())
					<a class="btn btn-primary" href="{{ route('pacient.edit',$pacient->id) }}"><i class="glyphicon glyphicon-edit"></i> edit</a>
				@endcan
				<a class="btn btn-warning col-md-offset-1 col-md-2" href="{{ route('showAllPacientlist') }}" ><i class="glyphicon glyphicon-back"></i> Back</a>
				<a class="btn btn-success col-md-2" href="#" onclick="window.print()" ><i class="glyphicon glyphicon-print"></i> Print</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>