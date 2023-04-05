@extends('layouts.app',['title'=>'Material List'])

@section('content')

<div class="container">
	<div class="panel panel-primary"style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading printTitle">
			 Less Materials List 
		</div>
		<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>Material ID</th>--}}
						<th>Test Name</th>
						<th>Branch</th>
						<th>Remained Quantity</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all materials-->			
					@foreach($data as $row)
					<tr>
						<td>{{$row->test->name}}</td>
						<td>{{$row->branch->name}}</td>
						<td>{{$row->quantity}}</td>
					</tr>
					@endforeach()
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<a href="#" onclick="window.print();" class="hidden-print btn-primary btn">Print</a>	
		</div>
	</div>
</div>
@stop