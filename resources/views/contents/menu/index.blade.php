@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-primary" onclick="addMenu()">
                            Add Menu
                        </button>
                    </div>
                    <div class="col-md-10">
                        <div id="form-create" class="collapse">
                            <form method="post" id="menu-form" action="{{ url('admin/menu') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="menu-name" class="form-control" placeholder="Menu Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Route</label>
                                            <input type="text" name="route" id="menu-route" class="form-control" placeholder="Menu Description" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-sm btn-primary" style="margin-top:30px;">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<th>Name</th>
                			<th>Slug</th>
                			<th>Route</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($menus)
                			@foreach ($menus as $menu)
                				<tr>
                					<td>{{ $menu->name }}</td>
                					<td>{{ $menu->slug }}</td>
                					<td>{{ $menu->route }}</td>
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
		function addMenu(){
			$('#menu-name').val('');
			$('#menu-route').val('');
			var url = window.location.origin + '/admin/menu';
			$('#menu-form').attr('action', url);

			if ($('#form-create').is(':visible')) {
				$('#form-create').collapse('hide');
			} else {
				$('#form-create').collapse('show');
			}
		}
	</script>
@endsection