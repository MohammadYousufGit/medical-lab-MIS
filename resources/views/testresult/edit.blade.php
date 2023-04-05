@extends('layouts.app',['title'=>'Edit branch'])
@section('content')



	{{--






	not workin
	not workin
	not workin
	not workin
	not workin
	not workin
	not workin
	not workin
	not workin




	--}}
<div class="container">

	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
		<div class="panel-heading">
			Edit branch
		</div>

		<form action="{{route('pacient.update',$data->id)}}" method="post">

			<div class="panel-body">
				
				{{ csrf_field() }}
				{{method_field('put')}}

	         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Branch Name</label>

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
					<a href="/branch" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Update">
	         </div>

			</div>


		</form>

	</div>

</div>

@stop