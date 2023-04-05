@extends('layouts.app',['title'=>'Stock List'])
@section('content')

@if(count($test) && count($branch) > 0)
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Create New material
		</div>

		<form action="{{ route('material.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="col-md-6 form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
	             <label for="branch" class="control-label">Branch</label>
	             <select name="branch" required="required" class="form-control">
	             	<option>select branch</option>
	             	@foreach($branch as $row)
	             	<option value="{{$row->id}}">{{$row->name}}</option>
	             	@endforeach
	             </select>
                 @if ($errors->has('branch'))
                     <span class="help-block">
                         <strong>{{ $errors->first('branch') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
	             <label for="quantity" class="control-label">quantity</label>

                 <input id="quantity" type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" required="required">

                 @if ($errors->has('quantity'))
                     <span class="help-block">
                         <strong>{{ $errors->first('quantity') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('test') ? ' has-error' : '' }}">
	             <label for="test" class="control-label">Select Test</label>
	             <select name="test" required="required" class="form-control">
	             	<option>Select test</option>
	             	@foreach($test as $row)
	             	<option value="{{$row->id}}">{{$row->name}}</option>
	             	@endforeach
	             </select>
                 @if ($errors->has('test'))
                     <span class="help-block">
                         <strong>{{ $errors->first('test') }}</strong>
                     </span>
                 @endif
	         </div>
			</div>
			<div class="panel-footer">

				<div class="form-group">
					<a href="/material" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Save">
	         </div>

			</div>
		</form>

	</div>
</div>
@else
	<div class="conainter">
		<h4 class="alert alert-warning">Please Register Branch & Test First</h4>
	</div>
@endif

@stop