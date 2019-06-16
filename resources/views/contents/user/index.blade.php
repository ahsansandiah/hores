@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<button class="btn btn-sm btn-primary" onclick="addUser()">
                    Add User
                </button>
            	<div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <div id="form-create" class="collapse">
                            <form method="post" id="user-form" action="{{ url('admin/user') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="user-name" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="user-email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="row">
                                            	<div class="col-md-6">
                                            		<input type="password" name="password" id="user-password" class="form-control" placeholder="Password" required>
                                            	</div>
                                            	<div class="col-md-6">
                                            		<input type="password" name="password_confirmation" id="user-password-confirmation" class="form-control" placeholder="Password Confirmation" required>
                                            	</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role_id" id="user-role" required>
                                            	@if (isset($roles) && $roles)
                                            		@foreach ($roles as $role)
                                            			<option value="{{ $role->id }}">{{ $role->name }}</option>
                                            		@endforeach
                                            	@endif
                                            </select>
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
                			<th>Name</th>
                			<th>Email</th>
                			<th>Role</th>
                			<th>Action</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($users)
                			@foreach ($users as $user)
                				<tr>
                					<td>{{ $user->name }}</td>
                					<td>{{ $user->email }}</td>
                					<td>{{ $user->getRoles()[0]->name }}</td>
                					<td>
                						<button class="btn btn-sm btn-warning">Edit</button>
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
		function addUser(){
			$('#user-name').val('');
			$('#user-email').val('');
			$('#user-password').val('');
			$('#user-role').val('');
			var url = window.location.origin + '/admin/user';
			$('#user-form').attr('action', url);

			if ($('#form-create').is(':visible')) {
				$('#form-create').collapse('hide');
			} else {
				$('#form-create').collapse('show');
			}
		}

		function editUser(id, password, name, email, role){
			$('#user-name').val(name);
			$('#user-email').val(email);
			$('#user-password').val(password);
			$('#user-role').val(role);
			var url = window.location.origin + '/admin/user/update/' + id;
			$('#user-form').attr('action', url);
			$('#form-create').collapse('show');
		}
	</script>
@endsection