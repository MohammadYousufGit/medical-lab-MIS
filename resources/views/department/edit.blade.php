@extends('layouts.app',['title'=>'Edit department'])
@section('content')

<div class="container">

	<div class="panel panel-primary">
		
		<div class="panel-heading">
			Edit department
		</div>

		<form action="{{ route('department.update',$data->id) }}" method="post">
			<div class="panel-body">
				
				{{ csrf_field() }}
				{{method_field('put')}}

	         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">department Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>


			</div>
			<div class="panel-footer">

				<div class="form-group">
					<a href="/department" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Update">
	         </div>

			</div>


		</form>

	</div>

</div>

@stop