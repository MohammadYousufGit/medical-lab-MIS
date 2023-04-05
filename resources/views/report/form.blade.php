@extends('layouts.app',['title'=>'Tabular Report Form'])
@section('head')
	<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@stop
@section('content')

<div class="container">
	<div class="panel panel-primary col-md-offset-2 col-md-8" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
		<div class="panel-heading">
			Register New Pacient
		</div>

		<form action="{{ route('tabular.show') }}" method="post">
			<div class="panel-body" >
				{{ csrf_field() }}
	         <div class="col-md-6 form-group">
	             <label for="from" class="control-label">From</label>

                 <input id="name" type="text" class="form-control" name="from" value="{{ old('name') }}" required>

	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	             <label for="phone" class="control-label">To</label>

                 <input id="phone" type="text" class="form-control" name="to" value="{{ old('phone') }}" required>

	         </div>
	         <div class="col-md-6 form-group">
	             <label for="address" class="control-label">Doctor</label>
				 <select class="form-control select2 select2-hidden-accessible" name="doctor"  data-placeholder="Select the doctor" style="width: 100%;" tabindex="-1" aria-hidden="true">
					 <option selected disabled >Select Doctor</option>
					 @foreach($doctors as $doctor)

                         <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                         @endforeach

                 </select>

	         </div>
	         <div class="col-md-6 form-group">
	             <label for="address" class="control-label">Branch</label>
				 <select class="form-control select2 select2-hidden-accessible" name="branch"  data-placeholder="Select the doctor" style="width: 100%;" tabindex="-1" aria-hidden="true">
					 <option selected disabled >Select Branch</option>
                     @foreach($branches as $branch)
                         <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                         @endforeach

                 </select>

	         </div>
	         <div class="col-md-6 form-group">
	             <label for="address" class="control-label">Tests</label>
				 <select class="form-control select2 select2-hidden-accessible" name="test_id"  data-placeholder="Select the doctor" style="width: 100%;" tabindex="-1" aria-hidden="true">
					 <option selected disabled >Select Test</option>
                     @foreach($tests as $test)

                         <option value="{{ $test->id }}">{{ $test->name }}</option>
                         @endforeach

                 </select>

	         </div>


	   		</div>
			<div class="panel-footer">
				
				<div class="form-group">

	            <input type="submit" class="btn btn-primary" value="Show">
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

        });


	</script>
@stop