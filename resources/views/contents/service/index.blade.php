@extends('layouts.main')
@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Service</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3 pull-left">
                                <div class="input-group margin">
                                    <a href="" class="btn btn-block btn-success btn-flat"  data-toggle="modal" data-target="#modal-default">Add</a>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Form Add Service</h4>
                                                    <div class="modal-body">
                                                        <form action="{{ url('service/store') }}" method="POST" class="form-horizontal">
                                                            @csrf
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                        <label for="code" class="col-sm-2 control-label">Select Room</label>
                                                                        <div class="col-sm-10">
                                                                                <div class="col-sm-3">
                                                                                        <select class="form-control">
                                                                                            <option>R001</option>
                                                                                            <option>R002</option>
                                                                                        </select>
                                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="code" class="col-sm-2 control-label">Code</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="code" placeholder="Code Product">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="Name" placeholder="Name Product">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control">
                                                                            <option>Laundry</option>
                                                                            <option>Food</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="piece" class="col-sm-2 control-label">piece</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="piece" placeholder="price at piece">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stock" class="col-sm-2 control-label">stock</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="stock" placeholder="stock">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="buy price" class="col-sm-2 control-label">buy price</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="buy_price" placeholder="Buy price">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sell_preice" class="col-sm-2 control-label">Sell Price</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="sell_price" placeholder="Sell Price">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
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
                                <th>Category</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th style="width: 40px"></th>
                            </tr>
                            <tr>
                                @foreach ($Services as $service)
                                    <td></td>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->category }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->stock }}</td>
                                    <td>{{ $service->price }}</td>
                                    <td> 1</td>
                                    <td>
                                        <a class="btn btn-app" href="{{ url('service/edit'. $service->id) }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a class="btn btn-app" href="{{ url('service/delete'. $service->id) }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
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
