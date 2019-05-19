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
                                <a href="" class="btn btn-block btn-success btn-flat"  data-toggle="modal" data-target="#modal-default">Create</a>
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Form Create Room</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('room/store') }}" method="POST" class="form-horizontal">
                                                    @csrf
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputRoomNumber" class="col-sm-2 control-label">Room Number</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="room_number" id="inputRoomNumber" placeholder="Room Number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputType" class="col-sm-2 control-label">Type</label>
                                                            <div class="col-sm-10">
                                                                <select name="type" id="">
                                                                    @foreach ($roomTypes as $type)
                                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPrice" class="col-sm-2 control-label">Price (/day)</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="price" id="inputPrice" placeholder="Price">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputBadType" class="col-sm-2 control-label">Bad Type</label>
                                                            <div class="col-sm-10">
                                                                <select name="bed_type" id="">
                                                                    @foreach ($roomBedTypes as $bedType)
                                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputGuestMax" class="col-sm-2 control-label">Guest Max</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="guest_max" id="inputGuestMax" placeholder="Guest Max">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputFeeBreakfast" class="col-sm-2 control-label">Fee Breakfast (/day)</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="fee_breakfast" id="inputFreeBreakfast" placeholder="Fee Breakfast">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputCondition" class="col-sm-2 control-label">Room Condition</label>
                                                            <div class="col-sm-10">
                                                                <select name="condition" id="">
                                                                    @foreach ($roomConditions as $condition)
                                                                        <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputCondition" class="col-sm-2 control-label">Description</label>
                                                            <div class="col-sm-10">
                                                                <textarea name="description " id="" cols="30" rows="10"></textarea>
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
                            <th>Room Number</th>
                            <th>Type</th>
                            <th>Price / Day</th>
                            <th>Guest Total</th>
                            <th style="width: 40px"></th>
                        </tr>
                        <tr>
                            @foreach ($rooms as $room)
                                <td></td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->type }}</td>
                                <td>{{ $room->price_day }}</td>
                                <td>{{ $room->guest_total }}</td>
                                <td>
                                    <a class="btn btn-app" href="{{ url('room/edit'. $room->id) }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a class="btn btn-app" href="{{ url('room/delete'. $room->id) }}">
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
