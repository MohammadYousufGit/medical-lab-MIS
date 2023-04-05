@extends('layouts.app',['title'=>'Create Pacient'])
@section('head')
	<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0 ;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
		<div class="panel-heading">
			Register New Pacient
		</div>

		<form action="{{ route('pacient.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Pacient Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-4 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	             <label for="phone" class="control-label">Phone</label>

                 <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required="required">

                 @if ($errors->has('phone'))
                     <span class="help-block">
                         <strong>{{ $errors->first('phone') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-4 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	             <label for="address" class="control-label">address</label>

                 <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required="required">

                 @if ($errors->has('address'))
                     <span class="help-block">
                         <strong>{{ $errors->first('address') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-4 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
	             <label for="gender" class="control-label">Gender:</label>
                 <select class="form-control" required="required" name="gender">
                 	<option value="1">Male</option>
                 	<option value="0">Female</option>
                 </select>
                 @if ($errors->has('gender'))
                     <span class="help-block">
                         <strong>{{ $errors->first('gender') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-4 form-group{{ $errors->has('age') ? ' has-error' : '' }}">
	             <label for="age" class="control-label">Age:</label>
				<input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required="required">                 
                 @if ($errors->has('age'))
                     <span class="help-block">
                         <strong>{{ $errors->first('age') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-4 form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
	             <label for="doctor" class="control-label">doctor:</label>
				 <select class="form-control select2 select2-hidden-accessible" name="doctor"  data-placeholder="Select the doctor" style="width: 100%;" tabindex="-1" aria-hidden="true">

                 	@foreach($doctor as $row)
                 	<option value="{{$row->id}}">{{$row->name}}</option>
                 	@endforeach
                 </select>
                 @if ($errors->has('doctor'))
                     <span class="help-block">
                         <strong>{{ $errors->first('doctor') }}</strong>
                     </span>
                 @endif
	         </div>

			<div class="form-group col-md-8" >
				<a href="#" id='submitButton' class="btn btn-default" >

				<label>Select Tests</label>
				</a>
				<select id="select2" class="form-control select2 select2-hidden-accessible" name="tests[]"  multiple data-placeholder="Select the test" style="width: 100%; border:1px solid red;" tabindex="-1" aria-hidden="true">
						@foreach($tests as $test)
					<option id="{{ $test->fee }}" value="{{ $test->id }}" >{{ $test->name }} &nbsp;{{ $test->fee }}/AFN</option>
					@endforeach
				</select>

				{{--<span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="qweq"><span class="select2-selection__choice__remove" role="presentation">×</span>qweq</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>--}}
			</div>
			<div class="col-md-4">
				<div class="form-group ">
					<label class="control-label col-sm-4" for="grant_rate">Grant Rate:</label>
					<div class="col-sm-8">
						<input type="text" name="grant" class="form-control" id='grant' readonly>
					</div>
				</div>
				@can('pacient.view',Auth::user())

				<div class="form-group ">
					<label class="control-label col-sm-4" for="grant_rate">Discount:</label>
					<div class="col-sm-8">
						<input type="text" name="discount" class="form-control" id='discount' value="0">
					</div>
				</div>
				@endcan
				<div class="form-group ">
					<label class="control-label col-sm-4" for="grant_rate">Total Rate:</label>
					<div class="col-sm-8">
						<input type="text" name="total" class="form-control" id='total' readonly>
					</div>
				</div>
			</div>
			</div>
			<div class="panel-footer">

				<div class="form-group">

					<a href="/pacient" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Save">
	         </div>

			</div>
		</form>

	</div>
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