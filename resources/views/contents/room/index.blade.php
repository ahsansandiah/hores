@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Ruangan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                            <div class="input-group margin">
                                <a href="" class="btn btn-block btn-success btn-flat"  data-toggle="modal" data-target="#modal-default">Tambah</a>
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Form Tambah Room</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('room/store') }}" method="POST" class="form-horizontal">
                                                    @csrf
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputRoomNumber" class="col-sm-2 control-label">No Ruangan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="room_number" id="inputRoomNumber" placeholder="">
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
                                                            <label for="inputGuestMax" class="col-sm-2 control-label">Maksimal Pelanggan</label>
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
                                                            <label for="inputCondition" class="col-sm-2 control-label">Deskripsi</label>
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
                            </div>
                        </div>
                        <form action="{{ url('room?search') }}" method="GET">
                            <div class="col-sm-3 pull-right">
                                <div class="input-group margin">
                                    <input type="text" class="form-control" name="search">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info btn-flat">Cari</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>No Ruangan</th>
                            <th>Tipe</th>
                            <th>Harga Sewa / Hari</th>
                            <th>Max Pelanggan</th>
                            <th>Status Ruangan</th>
                            <th>Status Reservasi</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($rooms as $room)
                            <tr>
                                <td></td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->roomType->name }}</td>
                                <td>{{ $room->price_day }}</td>
                                <td>{{ $room->guest_total }}</td>
                                <td>
                                    @if ($room->is_active == 1)
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($room->is_booking == 0)
                                        <span class="label label-success">Tersedia</span>
                                    @else
                                        <span class="label label-warning">Tidak Terserdia</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-app-table" data-toggle="modal" data-target="#modal-edit{{ $room->id }}">
                                        <i class="fa fa-edit"></i> Ubah
                                    </a>
                                    <div class="modal fade" id="modal-edit{{ $room->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Form Ubah Ruangan</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('room/update/'.$room->id) }}" method="POST" class="form-horizontal">
                                                        @csrf
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputRoomNumber" class="col-sm-2 control-label">No Ruangan</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="room_number" id="inputRoomNumber" value="{{ $room->room_number }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputType" class="col-sm-2 control-label">Tipe</label>
                                                                <div class="col-sm-10">
                                                                    <select name="type" id="">
                                                                        @foreach ($roomTypes as $type)
                                                                            <option value="{{ $type->id }}" {{ ($room->type == $type->id) ? "selected" : "" }}>{{ $type->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPrice" class="col-sm-2 control-label">Harga Sewa (/hari)</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="price" id="inputPrice" value="{{ $room->price_day }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputBadType" class="col-sm-2 control-label">Tipe Ranjang</label>
                                                                <div class="col-sm-10">
                                                                    <select name="bed_type" id="">
                                                                        @foreach ($roomBedTypes as $bedType)
                                                                            <option value="{{ $bedType->id }}" {{ ($room->bed_type == $bedType->id) ? "selected" : "" }}>{{ $bedType->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputGuestMax" class="col-sm-2 control-label">Maksimal Pelanggan</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="guest_max" id="inputGuestMax" value="{{ $room->guest_total }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputFeeBreakfast" class="col-sm-2 control-label">Biaya Sarapan (/hari)</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="fee_breakfast" id="inputFreeBreakfast" value="{{ $room->fee_breakfast }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputCondition" class="col-sm-2 control-label">Kondisi Ruangan</label>
                                                                <div class="col-sm-10">
                                                                    <select name="condition" id="">
                                                                        @foreach ($roomConditions as $condition)
                                                                            <option value="{{ $condition->id }}" {{ ($room->condition == $condition->id) ? "selected" : "" }}>{{ $condition->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputBadType" class="col-sm-2 control-label">Status</label>
                                                                <div class="col-sm-10">
                                                                    <select name="is_active" id="">
                                                                        <option value="true" {{ ($room->is_active == "1") ? "selected" : "" }}>Active</option>
                                                                        <option value="false"{{ ($room->is_active == "0") ? "selected" : "" }}>Deactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputCondition" class="col-sm-2 control-label">Keterangan</label>
                                                                <div class="col-sm-10">
                                                                    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $room->description }}</textarea>
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
                                    <a class="btn btn-app-table" href="{{ url('room/delete/'. $room->id) }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                    @if ($room->is_booking == 0)
                                        <a class="btn btn-app-table" href="{{ url('reservation/check-in/'. $room->room_number) }}">
                                            <i class="fa fa-sign-in"></i> Check In
                                        </a>
                                    @else
                                        @if ($room->reservations)
                                            <a class="btn btn-app-table" href="{{ url('reservation/check-out/'. $room->reservations->reservation_number) }}">
                                                <i class="fa fa-sign-out"></i> Check Out
                                            </a>
                                        @endif
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $rooms->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
