@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-danger">
            <div class="box-header with-border">
            <h3 class="box-title">List Room</h3>

            <div class="box-tools pull-right">
                <span class="label label-danger">{{ $countAvailableRooms }} Room Available</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <ul class="users-list clearfix" style="width: 40%;">
                @foreach ($rooms as $room)
                    <li>
                        <a href="" data-toggle="modal" data-target="#modal-default{{ $room->id }}">
                            <span class="info-box-icon {{ ($room->is_booking == '1') ? "bg-red" : "bg-blue" }}" style="font-size: 19px;">
                                {{ $room->room_number }}
                            </span>
                        </a>
                    </li>
                    <div class="modal fade" id="modal-default{{ $room->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Room Number : {{ $room->room_number }} {{ ($room->is_booking == '1') ? "( Unavailable )" : "( Available )" }}</h4>
                                </div>
                                <div class="modal-body">
                                    <span>{{ $room->roomType->name }}</span> | 
                                    <span>{{ 'Rp. ' . number_format($room->price_day, 0, ',', '.') . ' /day' }}</span>
                                    <hr>
                                        @if ($room->is_booking == '1')
                                            <a href="{{ url('reservation/checkout/'.$room->id) }}" class="btn btn-app">
                                                <i class="fa fa-sign-out"></i> Check Out
                                            </a>
                                        @else
                                            <a href="{{ url('reservation/checkin/'.$room->id) }}" class="btn btn-app">
                                                <i class="fa fa-sign-in"></i> Check In
                                            </a>
                                        @endif
                                        <a href="{{ url('reservation/edit/'.$room->id) }}" class="btn btn-app">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a class="btn btn-app" data-toggle="modal" data-target="#create-room">
                                            <i class="fa fa-plus"></i> Create
                                        </a>
                                        <a href="{{ url('reservation/create/'.$room->id) }}" class="btn btn-app">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    <hr>
                                        <span>Current Status : <a class="btn bg-maroon btn-flat margin">{{ $room->roomCondition->name }}</a></span>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                @endforeach
            </ul>
            <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
        </div>
        <!--/.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    {{-- Modal Create Room --}}
    <div class="modal fade" id="create-room">
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
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
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
@stop
