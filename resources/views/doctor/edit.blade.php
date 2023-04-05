@extends('layouts.app',['title'=>'Edit doctor'])
@section('content')

<div class="container">

	<div class="panel panel-primary">
		
		<div class="panel-heading">
			Edit doctor
		</div>
		<form action="{{ route('doctor.update',$data->id) }}" method="post">

			<div class="panel-body">
				
				{{ csrf_field() }}
				{{method_field('put')}}

	         <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Doctor Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class=" col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	             <label for="phone" class="control-label">Doctor phone</label>

                 <input id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}" required="required">

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
	            <input type="submit" class="btn btn-primary" value="Update">
	         </div>

			</div>


		</form>

	</div>

</div>

@stop