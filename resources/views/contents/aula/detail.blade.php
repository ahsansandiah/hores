@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Aula</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> 
                            <small class="pull-right"></small>
                        </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-3 invoice-col">
                            <p class="lead"><b> Detail Aula </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">ID :</th>
                                        <td>{{ $aula->id }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">No Aula :</th>
                                        <td>{{ $aula->number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori : </th>
                                        <td>{{ $aula->category }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Reservasi :</th>
                                        <td>
                                            @if ($aula->is_booking == 0)
                                                Tersedia
                                            @else
                                                Tidak Tersedia
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kondisi Aula :</th>
                                        <td>{{ $aula->aula_condition }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi :</th>
                                        <td>{{ $aula->description }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <p class="lead"><b> Deskripsi Reservasi </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Nomor Reservasi :</th>
                                        <td>{{ $aula->reservationAula->reservation_aula_number }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">No Identitas :</th>
                                        <td>{{ $aula->reservationAula->identity_card }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama : </th>
                                        <td>{{ $aula->reservationAula->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat : </th>
                                        <td>{{ $aula->reservationAula->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota :</th>
                                        <td>{{ $aula->reservationAula->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon :</th>
                                        <td>{{ $aula->reservationAula->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email :</th>
                                        <td>{{ $aula->reservationAula->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><b> Biaya Reservasi </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Tanggal Checkin :</th>
                                        <td>{{ $aula->reservationAula->checkin_date }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Tanggal Checkout :</th>
                                        <td>{{ $aula->reservationAula->checkout_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration :</th>
                                        <td>{{ $aula->reservationAula->duration }} /hari</td>
                                    </tr>
                                    <tr>
                                        <th>Atas Nama : </th>
                                        <td>{{ $aula->reservationAula->paid_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran : </th>
                                        <td>{{ $aula->reservationAula->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pembayaran :</th>
                                        <td>{{ $aula->reservationAula->paid_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Pembayaran :</th>
                                        <td>{{ $aula->reservationAula->payment_number_reference }}</td>
                                    </tr>
                                    @if ($aula->reservationAula->paid_status == "DP")
                                        <tr>
                                            <th>Total Bayar:</th>
                                            <td>{{ 'Rp. ' . number_format($aula->reservationAula->paid_total, 0, ',', '.') }} ( {{ $aula->reservationAula->paid_status }} ) </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>{{ 'Rp. ' . number_format($aula->reservationAula->total_price - $aula->reservationAula->paid_total, 0, ',', '.') }} ( Kekurangan ) </td>
                                        </tr>
                                    @else 
                                        <tr>
                                            <th>Total Bayar:</th>
                                            <td>{{ 'Rp. ' . number_format($aula->reservationAula->total_price, 0, ',', '.') }} ( {{ $aula->reservationAula->paid_status }} ) </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Total Pembayaran :</th>
                                        <td>{{ 'Rp. ' . number_format($aula->reservationAula->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="{{ url('aula/reservation/'.$aula->reservationAula->id.'/print' ) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                            @if ($aula->reservationAula->status == "booked")
                                <a href="{{ url('aula/reservation/edit/'.$aula->reservationAula->id) }}" class="btn btn-default">Edit</a>
                                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#payment"><i class="fa fa-credit-card"></i> Pembayaran </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Checkout Aula --}}
    <div class="modal fade" id="payment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Form Pembayaran Aula</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('aula/reservation/payment/'. $aula->reservationAula->id ) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPaidBy" class="col-sm-2 control-label">Atas Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="paid_by" id="inputPaidBy" placeholder="Atas Nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPaymentNumberReference" class="col-sm-2 control-label">Nomor Referensi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="payment_number_reference" id="inputPaymentNumberReference" placeholder="No Rekening, No Referensi,..">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPaidTotal" class="col-sm-2 control-label">Total Bayar</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="paid_total" id="inputPaidTotal" placeholder="Total Pembayaran">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPaymentNumberReference" class="col-sm-2 control-label">Metode</label>
                                <div class="col-sm-10">
                                    <select name="payment_method" id="inpuPaymentMethod">
                                        <option value="Tunai">Tunai</option>
                                        <option value="ATM">ATM</option>
                                        <option value="Cek">Cek</option>
                                        <option value="M-Banking">M-Banking</option>
                                        <option value="E-Banking">E-Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPaymentNumberReference" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="paid_status" id="inpuPaymentMethod">
                                        <option value="Lunas">Lunas</option>
                                        <option value="DP">DP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pembayaran</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="paid_date" class="form-control pull-right" id="checkout_date">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-info pull-right">Bayar</button>
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