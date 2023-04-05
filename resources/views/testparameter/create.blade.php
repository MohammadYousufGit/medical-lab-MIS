@extends('layouts.app',['title'=>'Parameter'])
@section('content')

@if(count($test)>0)
<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			Create New Paramter
		</div>
		<form action="{{route('parameter.store')}}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">Parameter Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('test') ? ' has-error' : '' }}">
	             <label for="test" class="control-label">Test</label>
	             <select name="test" required="required" class="form-control">
	             	<option>select test</option>
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
	         <div class="form-group">
	             <label for="live" class="control-label">
	             	<input type="checkbox" name="hasnormal" id="normal">Does it have normal range?
	             </label><br>
	         </div>
	         <div id="normalyes" class="hidden">
		         <div class="col-md-6 form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
		             <label for="unit" class="control-label">unit</label>

	                 <input id="unit" type="text" class="form-control" name="unit" value="{{ old('unit') }}">

	                 @if ($errors->has('unit'))
	                     <span class="help-block">
	                         <strong>{{ $errors->first('unit') }}</strong>
	                     </span>
	                 @endif
		         </div>
		         
		         <div class="col-md-6 form-group{{ $errors->has('normal') ? ' has-error' : '' }}">
		             <label for="normal" class="control-label">Normal range</label>

	                 <input id="normaltxtbox" type="text" class="form-control" name="normal" value="{{ old('normal') }}">

	                 @if ($errors->has('normal'))
	                     <span class="help-block">
	                         <strong>{{ $errors->first('normal') }}</strong>
	                     </span>
	                 @endif
		         </div>
	     	</div>
			</div>
			<div class="panel-footer">
				<div class="form-group">
					<a href="/test" class="btn btn-default">Cancel</a>
	             <input type="submit" class="btn btn-primary" value="Save">
	            </div>

			</div>
		</form>

	</div>
</div>
@else
	<div class="conainter">
		<h4 class="alert alert-warning">Please Register parameter First</h4>
	</div>
@endif

@stop

@section('script')

<script type="text/javascript">
	$(document).ready(function(){
		$("#normal").click(function(){
			if($(this).is(":checked"))
			{
				$("#normalyes").removeClass("hidden");
				$("#unit").attr('required','required');
				$("#normaltxtbox").attr('required','required');
			}
			else
			{
				$("#normalyes").addClass("hidden");
				$("#unit").attr('required','false');
				$("#normaltxtbox").attr('required','false');
			}

		});

	});


</script>


@stop