@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Room</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                            <div class="input-group margin">
                                <a href="" class="btn btn-block btn-success btn-flat" data-toggle="modal" data-target="#modal-default">Create</a>
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Form Create Room Condition</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('room/condition/store') }}" method="POST" class="form-horizontal">
                                                    @csrf
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputCondition" class="col-sm-2 control-label">Condition</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="name" id="inputCondition" placeholder="Condition">
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
                            <th>Name</th>
                            <th style="width: 40px"></th>
                        </tr>
                        <tr>
                            @foreach ($roomConditions as $condition)
                                <td>{{ $condition->id }}</td>
                                <td>{{ $condition->name }}</td>
                                <td>
                                    <a class="btn btn-app" data-toggle="modal" data-target="#modal-edit{{ $condition->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <div class="modal fade" id="modal-edit{{ $condition->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Form Edit Room Condition</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('room/condition/update') }}" method="POST" class="form-horizontal">
                                                        @csrf
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputCondition" class="col-sm-2 control-label">Condition</label>
                                                                <div class="col-sm-10">
                                                                    <input type="hidden" class="form-control" name="id" value="{{ $condition->id }}" id="inputCondition" placeholder="Condition">
                                                                    <input type="text" class="form-control" name="name" value="{{ $condition->name }}" id="inputCondition" placeholder="Condition">
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
                            @endforeach
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
