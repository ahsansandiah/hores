@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Actions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="row">
            		<div class="col-md-2">
            			<button class="btn btn-sm btn-primary" onclick="addAction()">Add Action</button>
            		</div>
            		<div class="col-md-10">
            			<div id="form-collapse" class="collapse">
            				<form method="post" action="{{ url('admin/action') }}" id="form-action">
            					@csrf
            					<div class="row">
            						<div class="col-md-8">
            							<div class="form-group">
            								<label>Name</label>
            								<input type="text" id="action-name" name="name" class="form-control" placeholder="Action Name" required>
            							</div>
            						</div>
            						<div class="col-md-4">
            							<button class="btn btn-sm btn-primary" style="margin-top: 30px;">
            								Submit
            							</button>
            						</div>
            					</div>
            				</form>
            			</div>
            		</div>
            	</div>
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<th>Name</th>
                			<th>Slug</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($actions)
                			@foreach ($actions as $action)
                				<tr>
                					<td>{{ $action->name }}</td>
                					<td>{{ $action->slug }}</td>
                				</tr>
                			@endforeach
                		@endif
                	</tbody>
                </table>
            </div>
        </div>
        <!--/.box -->
    </div>
    <!-- /.row -->
@stop

@section('script')
	<script type="text/javascript">
		function addAction(){
			$('#action-name').val('');
			var url = window.location.origin + '/admin/action';
            $('#form-action').attr('action', url);

			if ($('#form-collapse').is(':visible')) {
				$('#form-collapse').collapse('hide');
			} else {
				$('#form-collapse').collapse('show');
			}
		}
	</script>
@endsection
