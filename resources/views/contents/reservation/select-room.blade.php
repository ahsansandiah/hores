@extends('layouts.main')
@section('content')
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Ruangan | 
                        Jumlah Ruangan Tersedia : <span class="label label-success">{{ $countAvailableRooms }}</span>
                </h3>
                <div class="box-tools">
                    <form action="{{ url('/reservation/select-room/?search') }}" method="GET">
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
                            <li><a href="{{ url('/reservation/select-room/?is_booking=0') }}">Available</a></li>
                            <li><a href="{{ url('/reservation/select-room/?is_booking=1') }}">Unavailable</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/reservation/select-room') }}">Clear</a></li>
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
                                        <h4 class="modal-title">No Ruangan : {{ $room->room_number }} {{ ($room->is_booking == '1') ? "( Unavailable )" : "( Available )" }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span>{{ $room->roomType->name }}</span> | 
                                        <span>{{ 'Rp. ' . number_format($room->price_day, 0, ',', '.') . ' /day' }}</span>
                                        <hr>
                                            @if ($room->is_booking == '1')
                                                <a href="{{ url('reservation/check-out/'.$room->reservations['reservation_number']) }}" class="btn btn-app">
                                                    <i class="fa fa-sign-out"></i> Check Out
                                                </a>
                                                <a href="{{ url('reservation/detail/'.$room->reservations['reservation_number'] ) }}" class="btn btn-app">
                                                    <i class="fa fa-address-card"></i> Detail
                                                </a>
                                            @else
                                                @inject('RoomCondition', 'App\Entities\Room\RoomCondition')
                                                @if ($room->roomCondition->name == $room::STATUS_AVAILABLE)
                                                    <a href="{{ url('reservation/check-in/'.$room->room_number) }}" class="btn btn-app">
                                                        <i class="fa fa-sign-in"></i> Check In
                                                    </a>
                                                    | 
                                                @endif
                                            @endif
                                            <a href="{{ url('room/edit/'.$room->id) }}" class="btn btn-app">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a class="btn btn-app" data-toggle="modal" data-target="#create-room">
                                                <i class="fa fa-plus"></i> Tambah
                                            </a>
                                            <a href="{{ url('room/delete/'.$room->id) }}" class="btn btn-app" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        <hr>
                                            <span>Status Kondisi Ruangan : <a class="btn bg-primary btn-flat margin">{{ $room->roomCondition->name }}</a></span>
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
                                <label for="inputBadType" class="col-sm-2 control-label">Tipe Ranjang</label>
                                <div class="col-sm-10">
                                    <select name="bed_type" id="">
                                        @foreach ($roomBedTypes as $bedType)
                                            <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputGuestMax" class="col-sm-2 control-label">Max Orang</label>
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
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batalkan</button>
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
