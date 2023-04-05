@extends('layouts.app',['title'=>'Material List'])

@section('content')

<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		<div class="panel-heading">
			<a href="{{url('/material/create')}}" class="btn btn-xs btn-default">Add new Material</a> | Materials List
			<div class="pull-right">
				Total: <div class="badge">{{count($data)}}</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						{{-- <th>Material ID</th>--}}
						<th>Test Name</th>
						<th>Branch</th>
						<th>Remained Quantity</th>
						<th>Manipulation</th>
					</tr>
				</thead>
				<tbody>
					<!-- List of all materials-->			
					@foreach($data as $row)
					<tr class="@if($row->quantity<7) danger @endif">
						<td>{{$row->test->name}}</td>
						<td>{{$row->branch->name}}</td>
						<td>{{$row->quantity}}</td>
						<td>
							<form action="{{'/material/'.$row->id}}" method="post">
							    {{csrf_field()}}
							    {{method_field('delete')}}
								<div class="btn-group btn-group-xs" role="group">
									<a class="btn btn-primary" href="{{'/material/'.$row->id.'/edit'}}">edit</a>
									<input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
									<a class="btn btn-success" href="#" onclick="addNewQuantity({{$row->id}});">Add Quantity</a>
								</div>
							</form>
						</td>
					</tr>
					@endforeach()
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			{!!$data->links();!!}	
		</div>
	</div>
</div>
<!-- Start of Modal -->
<div class="container">
    <div class="row">
        <form class="form-horizontal" method="post" action="{{route('addNewQuantity')}}" >
                {{csrf_field()}}
        <div class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Qunatity</h4>
              </div>
              <div class="modal-body">
                    
                        <div class="form-group has-warning">
                            <label class="control-label" for="quantity">Number</label>
                            <input class="form-control" required id="quantity" name="quantity" min="1" type="number" placeholder="insert number">
                            <input class="form-control" required name="id" type="hidden" id="materialID">
                        </div>
                                
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Add +</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    // function to show modal
     function addNewQuantity(id){
        jQuery('.modal').modal('show').on('hide.bs.modal', function(e){
              jQuery('#materialID').val(id);
              e.preventDefault();
            });
            jQuery('.modal').modal('hide');
    }
    // End of show modal
</script>
@endsection