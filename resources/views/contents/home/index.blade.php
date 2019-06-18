@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Ruangan | 
                    Ruangan yang tersedia : <span class="label label-success"> {{ $countAvailableRooms }} </span>
                </h3>
                <div class="box-tools">
                    <form action="{{ url('/?search') }}" method="GET">
                        <input type="text" name="search" placeholder="">
                        <button type="submit" class="btn btn-info btn-flat" style="margin-right: 90px;"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="box-tools pull-right">
                    
                    <div class="btn-group">
                        <span class="btn btn-success btn-flat">Filter</span>
                        <button class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/?is_booking=0') }}">Tersedia</a></li>
                            <li><a href="{{ url('/?is_booking=1') }}">Tidak Tersedia</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/') }}">Bersihkan</a></li>
                        </ul>
                    </div>
                    {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
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
                                        <h4 class="modal-title">No Ruangan : {{ $room->room_number }} {{ ($room->is_booking == '1') ? "( Tidak Tersedia )" : "( Tersedia )" }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span>{{ $room->roomType->name }}</span> | 
                                        <span>{{ 'Rp. ' . number_format($room->price_day, 0, ',', '.') . ' /hari' }}</span>
                                        <hr>
                                        @if ($room->is_booking == '1')
                                            <a href="{{ url('reservation/check-out/'.$room->reservations['reservation_number']) }}" class="btn btn-app">
                                                <i class="fa fa-sign-out"></i> Check Out
                                            </a>
                                            <a href="{{ url('reservation/detail/'.$room->reservations['reservation_number'] ) }}" class="btn btn-app">
                                                <i class="fa fa-address-card"></i> Detail Reservation
                                            </a>
                                        @else
                                            @if ($room->condition == '1')
                                                <a href="{{ url('reservation/check-in/'.$room->room_number) }}" class="btn btn-app">
                                                    <i class="fa fa-sign-in"></i> Check In
                                                </a>
                                                |
                                            @endif
                                        @endif
                                        <a href="{{ url('room/edit/'.$room->id) }}" class="btn btn-app">
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>
                                        <a class="btn btn-app" data-toggle="modal" data-target="#create-room">
                                            <i class="fa fa-plus"></i> Tambah
                                        </a>
                                        @if ($room->is_booking != '1')
                                            <a href="{{ url('room/delete/'.$room->id) }}" class="btn btn-app" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        @endif
                                        <hr>
                                        <span>Status Ruangan : <a class="btn bg-maroon btn-flat margin">{{ $room->roomCondition->name }}</a></span>
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
            <div class="box-footer">
                {{ $rooms->links() }}
            </div>
            <!-- /.box-footer -->
        </div>
        <!--/.box -->
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-sign-in"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Check In <br><small>(Harian)</small></span>
                        <span class="info-box-number">{{ $checkinToday }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-sign-out"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Check Out <br><small>(Harian)</small></span>
                        <span class="info-box-number">{{ $checkoutToday }}</span>
                    </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
    
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
    
                <div class="info-box-content">
                    <span class="info-box-text">Reservasi</span>
                    <span class="info-box-number">{{ $countReservation }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
    
                <div class="info-box-content">
                    <span class="info-box-text">Total Pelanggan</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.row -->

    {{-- Modal Create Room --}}
    <div class="modal fade" id="create-room">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Form Tambah Ruangan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('room/store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">No Ruangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_number" id="inputRoomNumber" placeholder="Room Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputType" class="col-sm-2 control-label">Tipe</label>
                                <div class="col-sm-10">
                                    <select name="type" id="">
                                        @foreach ($roomTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice" class="col-sm-2 control-label">Harga Sewa (/hari)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="price" id="inputPrice" placeholder="Price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBadType" class="col-sm-2 control-label">Jenis Ranjang</label>
                                <div class="col-sm-10">
                                    <select name="bed_type" id="">
                                        @foreach ($roomBedTypes as $bedType)
                                            <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputGuestMax" class="col-sm-2 control-label">Max Pelanggan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="guest_max" id="inputGuestMax" placeholder="Guest Max">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFeeBreakfast" class="col-sm-2 control-label">Biaya Sarapan (/hari)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fee_breakfast" id="inputFreeBreakfast" placeholder="Fee Breakfast">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCondition" class="col-sm-2 control-label">Kondisi Ruangan</label>
                                <div class="col-sm-10">
                                    <select name="condition" id="">
                                        @foreach ($roomConditions as $condition)
                                            <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCondition" class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                            <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-info pull-right">Simpan</button>
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
