@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<button class="btn btn-sm btn-primary" onclick="addUser()">
                    Tambah User
                </button>
            	<div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <div id="form-create" class="collapse">
                            <form method="post" id="user-form" action="{{ url('admin/user') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" id="user-name" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" id="user-name" class="form-control" placeholder="Username" required>
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
                                            <label>Hak akses</label>
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
		                                    Simpan
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
                			<th>Nama</th>
                			<th>Username</th>
                			<th>Email</th>
                			<th>Hak akses</th>
                			<th>Aksi</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($users)
                			@foreach ($users as $user)
                				<tr>
                					<td>{{ $user->name }}</td>
                					<td>{{ $user->username }}</td>
                					<td>{{ $user->email }}</td>
                					<td>{{ $user->getRoles()[0]->name }}</td>
                					<td>
                						<button class="btn btn-sm btn-warning" onclick="editUser(<?=$user->id?>, '<?=$user->name?>', '<?=$user->email?>', <?=$user->getRoles()[0]->id?>)">Ubah</button>
                						<button class="btn btn-sm btn-danger" onclick="deleteUser(<?=$user->id?>)">Hapus</button>
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

    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Hapus Menu</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" id="delete-link" class="btn btn-primary">Iya</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@stop

@section('script')
	<script type="text/javascript">
		function addUser(){
			if ($('#form-create').is(':visible') && $('#user-name').val() == '') {
				$('#form-create').collapse('hide');
			} else {
				$('#form-create').collapse('show');
			}

			$('#user-name').val('');
			$('#user-email').val('');
			$('#user-password').val('');
			$('#user-password-confirmation').val('');
			$('#user-role').val('');
			var url = window.location.origin + '/admin/user';
			$('#user-form').attr('action', url);
		}

		function editUser(id, name, email, role){
			$('#user-name').val(name);
			$('#user-email').val(email);
			$('#user-password').val('').attr('required', false);
			$('#user-password-confirmation').val('').attr('required', false);
			$('#user-role').val(role);

			var url = window.location.origin + '/admin/user/update/' + id;
			$('#user-form').attr('action', url);
			$('#form-create').collapse('show');
		}

		function deleteUser(id){
			$('#modal-delete').modal('show');
			var url = window.location.origin + '/admin/user/delete/' + id;
			$('#delete-link').attr('href', url);
		}
	</script>
@endsection