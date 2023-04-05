@extends('layouts.app',['title'=>'Edit Parameter'])
@section('content')

<div class="container">

	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
		<div class="panel-heading">
			Edit Parameter
		</div>

		<form action="{{'/parameter/'.$data->id}}" method="post">

			<div class="panel-body">
				
				{{ csrf_field() }}
				{{method_field('put')}}

	         <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Parameter Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
	             <label for="unit" class="control-label">Parameter Unit</label>
                 <input id="unit" type="text" class="form-control" name="unit" value="{{ $data->unit }}">

                 @if ($errors->has('unit'))
                     <span class="help-block">
                         <strong>{{ $errors->first('unit') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('normal') ? ' has-error' : '' }}">
	             <label for="normal" class="control-label">Normal range</label>

                 <input id="normal" type="text" class="form-control" name="normal" value="{{ $data->normal }}">

                 @if ($errors->has('normal'))
                     <span class="help-block">
                         <strong>{{ $errors->first('normal') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('test') ? ' has-error' : '' }}">
	             <label for="test" class="control-label">Select test</label>

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


			</div>
			<div class="panel-footer">

				<div class="form-group">
					<a href="{{url('/test/'.$data->test_id)}}" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Update">
	         </div>

			</div>


		</form>

	</div>
</div>
@stop