@extends('layouts.app',['title'=>'doctor List'])
@section('content')
<div class="container">

	<div class="panel panel-primary">
		
		<div class="panel-heading">
			Create New Doctor
		</div>

		<form action="{{ route('doctor.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
	             <label for="name" class="control-label">Doctor Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required" />

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	             <label for="phone" class="control-label">Doctor phone</label>

                 <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required="required" />

                 @if ($errors->has('phone'))
                     <span class="help-block">
                         <strong>{{ $errors->first('phone') }}</strong>
                     </span>
                 @endif
	         </div>
			</div>
			<div class="panel-footer">
				
				<div class="form-group">
					<a href="/doctor" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Save">
	         </div>

			</div>
		</form>

	</div>

</div>

@stop