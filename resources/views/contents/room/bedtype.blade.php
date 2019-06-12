@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tipe Ruangan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                            <div class="input-group margin">
                                <a href="" class="btn btn-block btn-success btn-flat" data-toggle="modal" data-target="#modal-default">Tambah</a>
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Form tambah tipe ruangan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('room/bed_type/store') }}" method="POST" class="form-horizontal">
                                                    @csrf
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputbedType" class="col-sm-2 control-label">Tipe</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="name" id="inpubedType" placeholder="bed_type">
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info pull-right">Save</button>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                <!-- /.modal-dialog -->
                                </div>
                            <!-- /.modal -->
                            </div>
                        </div>
                        <div class="col-sm-3 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat">Search</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($roombedTypes as $bedtype)
                        <tr>
                            <td>{{ $bedtype->id }}</td>
                            <td>{{ $bedtype->name }}</td>
                            <td>
                                <a class="btn btn-app" data-toggle="modal" data-target="#modal-edit{{ $bedtype->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <div class="modal fade" id="modal-edit{{ $bedtype->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Form edit tipe ruangan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('room/bed_type/update') }}" method="POST" class="form-horizontal">
                                                    @csrf
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputbedType" class="col-sm-2 control-label">Type</label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" class="form-control" name="id" value="{{ $bedtype->id }}" id="inputbedType" placeholder="bed_type">
                                                                <input type="text" class="form-control" name="name" value="{{ $bedtype->name }}" id="inputbedType" placeholder="bed_type">
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info pull-right">Save</button>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                <!-- /.modal-dialog -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $roombedTypes->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
