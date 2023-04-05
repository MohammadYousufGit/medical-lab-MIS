@extends('layouts.app',['title'=>'Create Pacient'])
@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
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
                 <select class="form-control" required="required" name="doctor">
                 	<option disabled="disabled">Select reffered</option>
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