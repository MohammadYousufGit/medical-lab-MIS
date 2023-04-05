@extends('layouts.app',['title'=>'Edit branch'])
@section('head')
	<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('content')

	<div class="container">

		<form role="form" action="{{ route('pacient.update',$pacient->id) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="panel panel-primary" style="border: none;padding:0 ;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">


				<div class="panel-body">
					{{ csrf_field() }}
					<div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="control-label">Pacient Name</label>

						<input id="name" type="text" class="form-control" name="name" value="{{ $pacient->name }}" required="required">

						@if ($errors->has('name'))
							<span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
						@endif
					</div>
					<div class="col-md-4 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label for="phone" class="control-label">Phone</label>

						<input id="phone" type="text" class="form-control" name="phone" value="0{{ $pacient->phone }}" required="required">

						@if ($errors->has('phone'))
							<span class="help-block">
                         <strong>{{ $errors->first('phone') }}</strong>
                     </span>
						@endif
					</div>
					<div class="col-md-4 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
						<label for="address" class="control-label">address</label>

						<input id="address" type="text" class="form-control" name="address" value="{{ $pacient->address }}" required="required">

						@if ($errors->has('address'))
							<span class="help-block">
                         <strong>{{ $errors->first('address') }}</strong>
                     </span>
						@endif
					</div>
					<div class="col-md-4 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
						<label for="gender" class="control-label">Gender:</label>
						<select class="form-control" required="required" name="gender">
							<option value="1" @if($pacient->gender == 1) selected @endif>Male</option>
							<option value="0" @if($pacient->gender == 0) selected @endif>Female</option>
						</select>
						@if ($errors->has('gender'))
							<span class="help-block">
                         <strong>{{ $errors->first('gender') }}</strong>
                     </span>
						@endif
					</div>
					<div class="col-md-4 form-group{{ $errors->has('age') ? ' has-error' : '' }}">
						<label for="age" class="control-label">Age:</label>
						<input id="age" type="text" class="form-control" name="age" value="{{ $pacient->age }}" required="required">
						@if ($errors->has('age'))
							<span class="help-block">
                         <strong>{{ $errors->first('age') }}</strong>
                     </span>
						@endif
					</div>
					<div class="col-md-4 form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
						<label for="doctor" class="control-label">doctor:</label>
						<select class="form-control select2 select2-hidden-accessible" name="doctor"   data-placeholder="Select the tag" style="width: 100%;" tabindex="-1" aria-hidden="true">

							@foreach($doctor as $row)
								<option @if($pacient->doctor->id == $row->id) selected @endif value="{{$row->id}}">{{$row->name}}</option>
							@endforeach
						</select>
						@if ($errors->has('doctor'))
							<span class="help-block">
                         <strong>{{ $errors->first('doctor') }}</strong>
                     </span>
						@endif
					</div>

					<div class="form-group col-md-8" >
						<a href="#" id='submitButton'>

							<label>Select Tests</label>
						</a>
						<select id="select2" class="form-control select2 select2-hidden-accessible" name="tests[]"  multiple data-placeholder="Select the tag" style="width: 100%;" tabindex="-1" aria-hidden="true">
							@foreach($tests as $test)

								<option
										@foreach($pacient->tests as $pt)
										@if($pt->id == $test->id) selected @endif
										@endforeach
								id="{{ $test->fee }}" value="{{ $test->id }}" >{{ $test->name }} &nbsp;{{ $test->fee }}/AFN</option>
							@endforeach
						</select>


					</div>
					<div class="col-md-4">
						<div class="form-group ">
							<label class="control-label col-sm-4" for="grant_rate">Grant Rate:</label>
							<div class="col-sm-8">
								<input type="text" name="grant" class="form-control" id='grant' value="{{ $pacient->total_amount }}" readonly>
							</div>
						</div>
						<div class="form-group ">
							<label class="control-label col-sm-4" for="grant_rate">Discount:</label>
							<div class="col-sm-8">
								<input type="text" name="discount" class="form-control" id='discount' value="0">
							</div>
						</div>
						@php
					$total = $pacient->total_amount - $pacient->discount;

					@endphp
						<div class="form-group ">
							<label class="control-label col-sm-4" for="grant_rate">Total Rate:</label>
							<div class="col-sm-8">
								<input type="text" name="total" class="form-control" id='total' readonly value="{{ $total }}">
							</div>
						</div>
					</div>

				</div>
				<div class="panel-footer">

					<div class="form-group">

						<a href="/pacient" class="btn btn-default">Cancel</a>
						<a href="{{ route('print_bill',$pacient->id) }}" class="btn btn-default">Receipt</a>
						<input type="submit" class="btn btn-primary" value="Edit">
					</div>

				</div>


			</div>



		</form>
	</div>



@stop

@section('script')
	<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
            var select2 = document.getElementById("select2");
            var submitButton = document.getElementById("submitButton");
            var sum = 0;
            var total = sum;
            var discount = 0;
            var payed = 0;
            $("#submitButton").click(function () {

                for(e of select2.options){
                    if(e.selected){
                        sum = sum + parseInt(e.id);
                    }
                }
                //end of for loop
                document.getElementById("grant").value = sum;
                document.getElementById("total").value = sum;
				total = sum;
            });

           
            $('#discount').keyup(function () {

                 discount= document.getElementById('discount').value;
                 total = document.getElementById('grant').value;

                 if (discount <0 ) {
                 	alert("Discount could not be null!");
                 }
                 else{

                 	if(discount!=null)
                    showTotal();
                else{
                	discount = 0;
                	showTotal();

                } 
                 }
                
            });

		function showTotal() {


            document.getElementById("total").value = total - discount;
        }
        });
		


	</script>
@stop