@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Ubah | {{ $reservation->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/update/'. $reservation->id) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Reservasi</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" value="{{ $reservation->reservation_number }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Ruangan</label>
                                    <input type="text" class="form-control" name="contact_name" id="input_contact_name" value="{{ $room->roomType->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Ranjang</label>
                                    <input type="text" class="form-control" name="contact_name" value="{{ $room->roomBedType->name }}" id="input_contact_name" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Check In</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                            <input type="text" class="form-control pull-right" id="checkin_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Check Out</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" class="form-control pull-right" id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="number" name="duration" class="form-control pull-right" value="1" min="0" max="1000" step="1"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanda Pengenal</label>
                                    <div class="form-inline">
                                        <select class="form-control" name="type_identity_card">
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>PASSPOR</option>
                                        </select>
                                        <select class="form-control">
                                            <option>Tuan.</option>
                                            <option>Nyonya.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Identitas</label>
                                    <input type="text" class="form-control" name="identity_number" id="input_contact_name" value="{{ $reservation->identity_card }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" id="input_contact_name" value="{{ $reservation->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" id="" class="form-control">
                                        {{ $reservation->address }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="city" id="input_contact_name" value="{{ $reservation->city }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" value="{{ $reservation->phone_number }}">
                                </div>
                                <div class="form-group">
                                    <label>Dewasa</label>
                                    <input type="text" class="form-control" name="adult" id="input_contact_name" value="{{ $reservation->adult_guest}}">
                                </div>
                                <div class="form-group">
                                    <label>Anak-anak</label>
                                    <input type="text" class="form-control" name="child" id="input_contact_name" value="{{ $reservation->child_guest}}">
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="job" id="input_contact_name" placeholder="Job">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control">
                                        {{ $reservation->description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Harga Sewa / Hari</label>
                                    <input type="hidden" class="form-control" name="reservation_cost_id" id="reservation_cost_id" value="{{ $reservation->reservationCost->id }}">
                                    <input type="text" class="form-control" name="price_day" id="input_base_price" value="{{ $reservation->reservationCost->base_price }}">
                                </div>
                                <div class="form-group">
                                    <label>Tip Servis</label>
                                    <input type="text" class="form-control" name="service_tip" id="input_service_tip" value="{{ $reservation->reservationCost->service_tip }}">
                                </div>
                                <div class="form-group">
                                    <label>Pajak</label>
                                    <input type="text" class="form-control" name="tax" id="input_tax" value="{{ $reservation->reservationCost->tax }}">
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <input type="text" class="form-control" name="discount" id="input_discount" value="{{ $reservation->reservationCost->discount }}">
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="input_deposit" value="{{ $reservation->reservationCost->deposit }}">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-block btn-success btn-lg">Simpan</button>
                        <a href="{{ url('/reservation') }}" class="btn btn-block btn-primary btn-lg">Batal</a>
                    </div>
                </form>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop





























