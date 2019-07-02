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
                                <label for="inputGuestMax" class="col-sm-2 control-label">Guest Max</label>
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
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
