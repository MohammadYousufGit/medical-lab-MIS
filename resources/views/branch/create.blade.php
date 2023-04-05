@extends('layouts.app',['title'=>'Branch List'])
@section('content')

<div class="container">

	<div class="panel panel-primary">
		
		<div class="panel-heading">
			Create New Branch
		</div>

		<form action="{{ route('branch.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Branch Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
			</div>
			<div class="panel-footer">
				
				<div class="form-group">
					<a href="/branch" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Save">
	         </div>

			</div>
		</form>

	</div>

</div>

@stop