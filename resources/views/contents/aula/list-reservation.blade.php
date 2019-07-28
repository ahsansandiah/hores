@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi Aula</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                        </div>
                        <div class="col-sm-3 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nomor Reservasi</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Durasi Sewa /hari</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($reservationAula as $reservation)
                        <tr>
                            <td>{{ $reservation->reservation_aula_number }}</td>
                            <td>{{ $reservation->name }}</td>
                            <td>{{ $reservation->phone_number }}</td>
                            <td>{{ $reservation->duration }}</td>
                            <td>
                                <a class="btn btn-app" href="{{ url('aula/reservation/detail/'. $reservation->id) }}">
                                    <i class="fa fa-edit"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $reservationAula->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
