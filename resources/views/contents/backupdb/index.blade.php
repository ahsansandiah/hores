@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Backup Database</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ url('backup-db/process') }}" class="btn btn-success btn-flat">Backup</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Lokasi File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{ $path.'mysql-hores.sql' }}">Backup Terakhir</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop