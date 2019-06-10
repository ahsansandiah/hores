@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservation</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                            <div class="input-group margin">
                                <a href="{{ url('reservation/select-room') }}" class="btn btn-block btn-success btn-flat ">Tambah Reservasi</a>
                            </div>
                        </div>
                        <div class="col-sm-4 pull-right">
                            <div class="input-group margin">
                                <form action="{{ url('/reservation/?search') }}" method="GET">
                                    <span class="input-group-btn">
                                        <input type="text" name="search" class="form-control">
                                        <button type="submit" class="btn btn-info btn-flat">Search</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>No Reservasi</th>
                            <th>No Ruangan</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Tanggal Check In</th>
                            <th>Tanggal Check Out</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td></td>
                                <td>{{ $reservation->reservation_number }}</td>
                                <td>{{ $reservation->room_number }}</td>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone_number }}</td>
                                <td>{{ $reservation->checkin_date }}</td>
                                <td>{{ $reservation->checkout_date }}</td>
                                <td>
                                    @if ($reservation->reservationCost->status == "checkin")
                                        <a class="btn btn-app" href="{{ url('reservation/edit'. $reservation->id) }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a class="btn btn-app" href="{{ url('reservation/delete'. $reservation->id) }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                        <a class="btn btn-app" href="{{ url('reservation/checkout') }}">
                                            <i class="fa fa-sign-out"></i> Check Out
                                        </a>
                                    @endif
                                    <a class="btn btn-app" href="{{ url('reservation/detail/'.$reservation->reservation_number) }}">
                                        <i class="fa fa-address-card"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
