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
            	<button class="btn btn-sm btn-primary" onclick="addMenu()">
                    Add Menu
                </button>
            	<div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <div id="form-create" class="collapse">
                            <form method="post" id="menu-form" action="{{ url('admin/menu') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <select class="form-control" name="parent_id" id="parent-id">
                                            	<option value="">- No Parent -</option>
                                            	@if ($menus)
                                            		@foreach ($menus as $menu)
                                            			@if (empty($menu->parent_id))
                                            				<option value="{{ $menu->id }}">
                                            					{{ $menu->name }}
                                            				</option>
                                            			@endif
                                            		@endforeach
                                            	@endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="menu-name" class="form-control" placeholder="Menu Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Route</label>
                                            <input type="text" name="route" id="menu-route" class="form-control" placeholder="Menu Description">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" name="icon" id="menu-icon" class="form-control" placeholder="Menu Icon">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
		                                <button class="btn btn-sm btn-primary">
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
                			<th>Parent</th>
                			<th>Name</th>
                			<th>Slug</th>
                			<th>Route</th>
                			<th>Action</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($menus)
                			@foreach ($menus as $menu)
                				<tr>
                					<td>{{ $menu->parent_name }}</td>
                					<td>{{ $menu->name }}</td>
                					<td>{{ $menu->slug }}</td>
                					<td>{{ $menu->route }}</td>
                					<td>
                						<button class="btn btn-sm btn-warning" onclick="editMenu(<?=$menu->id?>, <?=empty($menu->parent_id) ? 0 : $menu->parent_id?>, '<?=$menu->name?>', '<?=$menu->route?>', '<?=$menu->icon?>')">Edit</button>
                						<button class="btn btn-sm btn-danger">Delete</button>
                					</td>
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
			$('#parent-id').val('');
			$('#menu-icon').val('');
			var url = window.location.origin + '/admin/menu';
			$('#menu-form').attr('action', url);

			if ($('#form-create').is(':visible')) {
				$('#form-create').collapse('hide');
			} else {
				$('#form-create').collapse('show');
			}
		}

		function editMenu(id, parent_id, name, route, icon){
			$('#menu-name').val(name);
			$('#menu-route').val(route);
			$('#parent-id').val(parent_id);
			$('#menu-icon').val(icon);
			var url = window.location.origin + '/admin/menu/update/' + id;
			$('#menu-form').attr('action', url);
			$('#form-create').collapse('show');
		}
	</script>
@endsection