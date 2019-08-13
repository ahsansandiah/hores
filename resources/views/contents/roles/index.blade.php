@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Hak akses user</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-primary" onclick="clearForm()">
                            Tambah Hak Akses
                        </button>
                    </div>
                    <div class="col-md-10">
                        <div id="form-create" class="collapse">
                            <form method="post" id="role-form" action="{{ url('admin/role') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" id="role-name" class="form-control" placeholder="Role Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <input type="text" name="description" id="role-description" class="form-control" placeholder="Role Description" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-sm btn-primary" style="margin-top:30px;">
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
                			<th>Slug</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                		</tr>
                	</thead>
                	<tbody>
                		@if ($roles)
                			@foreach ($roles as $role)
                				<tr>
                					<td>{{ $role->name }}</td>
                					<td>{{ $role->slug }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        @if ($role->slug !== 'admin')
                                            <button type="button" class="btn btn-sm btn-warning" onclick="editRole(<?=$role->id?>, '<?=$role->name?>', '<?=$role->description?>')">
                                                Ubah
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete" onclick="setDeleteUrl(<?=$role->id?>)">
                                                Hapus
                                            </button>
                                            <button class="btn btn-sm btn-success" onclick="setRoleMenu(<?=$role->id?>, '<?=$role->name?>')">
                                                Set Menu
                                            </button>
                                        @endif
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
            <h4 class="modal-title">Hapus Hak akses</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <a href="#" id="delete-link" class="btn btn-primary">Ya</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="role-menu-modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Set Menu</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <label>Hak Akses</label>
                    <p class="label bg-green" style="display: block; padding: 10px !important;" id="role-name-modal"><p>
                    <input type="hidden" name="role_id" id="role-id">
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Menu</label>
                        <select class="form-control select2" data-placeholder="Select Role Menus" style="width: 100%;" id="role-menu">
                            @if($menus)
                                @foreach($menus as $menu)
                                    @if (count($menu->children) > 0)
                                        <optgroup label="{{ $menu->name }}">
                                            @foreach ($menu->children as $child)
                                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Aksi</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Select Menu Actions" style="width: 100%;" id="role-actions">
                            @if($actions)
                                @foreach($actions as $action)
                                    <option value="{{ $action->id }}">{{ $action->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="role-menu-list"></tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
            <button id="save-role-menu-btn" class="btn btn-primary" onclick="saveRoleMenu()">Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #2196f3;
            border-color: #2196f3;
            color: #ffffff;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
        }
        .select2-container .select2-selection--single {
            height: 35px;
        }
    </style>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminLTE/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2').select2();
        });

        function clearForm() {
            $('#role-name').val('');
            $('#role-description').val('');
            var url = "{{ url('/admin/role') }}";
            $('#role-form').attr('action', url);
            if ($('#form-create').is(':visible')) {
                $('#form-create').collapse('hide');
            } else {
                $('#form-create').collapse('show');
            }
        }

        function editRole(id, name, description){
            var url = "{{ url('/admin/role/update/') }}" + "/" + id;
            $('#role-form').attr('href', url);
            $('#role-name').val(name);
            $('#role-description').val(description);

            $('#form-create').collapse('show');
        }

        function setDeleteUrl(id) {
            var url = "{{ url('/admin/role/delete/') }}" + "/" +id;
            $('#delete-link').attr('href', url);
        }

        function setRoleMenu(id, name) {
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('/admin/menu/get-role-menu/') }}" + "/" + id,
                success: function(response) {
                    var menus = response.data;
                    var list_menu = '';
                    if (menus.length > 0) {
                        $.each(menus, function(index, menu){
                            console.log(JSON.stringify(menu));
                            list_menu += '<tr>\
                                <td>'+ menu.name +'</td>\
                                <td>'+ menu.actions.join('|') +'</td>\
                                <td><button class="btn btn-sm btn-danger">Hapus</button></td>\
                            </tr>';
                        });
                    }
                    $('#role-menu-list').html(list_menu);
                }
            })
            $('#role-menu-modal').modal('show');
            $('#role-name-modal').html(name);
            $('#role-id').val(id);
        }

        function saveRoleMenu(){
            var role_id = $('#role-id').val();
            var role_menu = $('#role-menu').val();
            var role_actions = $('#role-actions').val();

            $.ajax({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                url: "{{ url('/api/role/set-menu') }}",
                data: {
                    role_id: role_id,
                    menu_id: role_menu,
                    actions: role_actions
                },
                success: function (response){
                    if (response.error === false) {
                        var menus = response.data
                        var list_menu = '';
                        if (menus.length > 0) {
                            $.each(menus, function(index, menu){
                                list_menu += '<tr>\
                                    <td>'+ menu.name +'</td>\
                                    <td>'+ menu.actions.join('|') +'</td>\
                                </tr>';
                            });
                        }
                        $('#role-menu-list').html(list_menu);
                    }
                }
            });
        }

        function deleteRoleMenu(id){
            console.log('role menu id =',id);
        }
    </script>
@endsection
