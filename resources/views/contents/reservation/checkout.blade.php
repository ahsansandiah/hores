@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Check Out</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form role="form" method="POST" action="{{ url('reservation/check-out/'.$reservation->reservation_number.'/process') }}">
                            @csrf
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="room_number" value="{{ $reservation->room_number }}" id="inputTotalPayment">
                                </div>
                                <div class="form-group">
                                    <label>Total Pembayaran</label>
                                    <input type="text" class="form-control" name="total_price" value="{{ number_format($reservation->reservationCost->total_price, 0, ',', '.') }}" id="inputTotalPayment" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Total Kekurangan Pembayaran</label>
                                    <input type="text" class="form-control" name="underpayment" value="{{ number_format($reservation->reservationCost->underpayment, 0, ',', '.') }}" id="inputTotalUnderpayment" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Pembayaran</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="payment_type" value="Tunai" id="inputPaymentType">Tunai
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="payment_type" value="Kredit" id="inputPaymentType" >Kredit
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Bayar</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                            <input type="text" class="form-control pull-right" name="payment_date" id="datetimepicker1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dibayarkan Oleh</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="paid_by" value="Tunai" id="inputPaidBy">Personal
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="paid_by" value="Kredit" id="inputPaidBy" >Instansi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nomor Indentitas</label>
                                    <input type="text" class="form-control" name="identity_number" value="{{ $reservation->identity_card }}" id="inputIdentityNumber">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{ $reservation->name }}" id="inputName">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" id="inputAddress" value="" class="form-control">{{ $reservation->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ $reservation->phone_number }}" id="inputPhoneNumber" placeholder="08*******">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Checkout</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" value="{{ $reservation->checkout_date }}" class="form-control pull-right " id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
                                    <a href="{{ url('reservation/') }}" class="btn btn-warning pull-right" style="margin-right: 3px;">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div class="box-footer">
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop





























