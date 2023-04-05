@extends('layouts.app',['title'=>'Edit Material'])
@section('content')
<div class="container">

	<div class="panel panel-primary">
		
		<div class="panel-heading">
			Edit material
		</div>

		<form action="{{route('material.update',$data->id)}}" method="post">

			<div class="panel-body">
				
				{{ csrf_field() }}
				{{method_field('put')}}

	         <div class="col-md-6 form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
	             <label for="quantity" class="control-label">material quantity</label>

                 <input id="quantity" type="text" class="form-control" name="quantity" value="{{ $data->quantity }}" required="required">

                 @if ($errors->has('quantity'))
                     <span class="help-block">
                         <strong>{{ $errors->first('quantity') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('test') ? ' has-error' : '' }}">
	             <label for="test" class="control-label">Belongs To Test</label>

                 <select name="test" required="required" class="form-control">
	             	@foreach($test as $row)
	             	<option value="{{$row->id}}" @if($data->test_id == $row->id) selected="selected" @endif>{{$row->name}}</option>
	             	@endforeach
	             </select>
                 @if ($errors->has('test'))
                     <span class="help-block">
                         <strong>{{ $errors->first('test') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
	             <label for="branch" class="control-label">Belongs To branch</label>

                 <select name="branch" required="required" class="form-control">
	             	@foreach($branch as $row)
	             	<option value="{{$row->id}}" @if($data->branch_id == $row->id) selected="selected" @endif>{{$row->name}}</option>
	             	@endforeach
	             </select>
                 @if ($errors->has('branch'))
                     <span class="help-block">
                         <strong>{{ $errors->first('branch') }}</strong>
                     </span>
                 @endif
	         </div>


			</div>
			<div class="panel-footer">

				<div class="form-group">
					<a href="/material" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Update">
	         </div>

			</div>


		</form>

	</div>
</div>

@stop