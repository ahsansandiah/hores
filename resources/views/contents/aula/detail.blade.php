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
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
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
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row no-print">
                        <div class="col-xs-12">
                            @if ($aula->reservationAula)
                                <a href="{{ url('aula/reservation/'.$aula->reservationAula->id.'/print' ) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                @if ($aula->reservationAula->status == "booked")
                                    <a href="{{ url('aula/reservation/edit/'.$aula->reservationAula->id) }}" class="btn btn-default">Edit</a>
                                    <a href="{{ url('aula/reservation/detail/'.$aula->reservationAula->id) }}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Pembayaran </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop