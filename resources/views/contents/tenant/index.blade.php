@extends('layouts.main')
@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Penghuni</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3 pull-left">
                            </div>
                            <div class="col-sm-3 pull-right">
                                <div class="input-group margin">
                                    <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat">Cari</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <th>No Identitas</th>
                                <th>Nama</th>
                                <th>No Telepon</th>
                            </tr>
                            @foreach ($tenants as $tenant)
                            <tr>
                                <td>{{ $tenant->identity_card_number }}</td>
                                <td>{{ $tenant->name }}</td>
                                <td>{{ $tenant->phone_number }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{ $tenants->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
@stop
