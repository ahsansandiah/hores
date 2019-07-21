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
                        <div class="col-sm-4 invoice-col">
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
                        <div class="col-sm-4 invoice-col">
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
                        <div class="col-sm-4 invoice-col">
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
                                        <td>{{ $aula->reservationAula->duration }}</td>
                                    </tr>
                                    <tr>
                                        <th>Atas Nama : </th>
                                        <td>{{ $aula->reservationAula->paid_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran : </th>
                                        <td>{{ $aula->reservationAula->payment_methode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pembayaran :</th>
                                        <td>{{ $aula->reservationAula->paid_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Pembayaran :</th>
                                        <td>{{ $aula->reservationAula->payment_number_reference }}</td>
                                    </tr>
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
                                <a class="btn btn-success pull-right" href="{{ url('aula/reservation/check-out/'.$aula->reservationAula->id ) }}"><i class="fa fa-credit-card"></i> Checkout </a>
                            @endif
                            {{-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Cetak
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop