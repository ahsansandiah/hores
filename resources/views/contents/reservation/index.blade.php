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
                                <a href="{{ url('reservation/create') }}" class="btn btn-block btn-success btn-flat ">Create</a>
                            </div>
                        </div>
                        <div class="col-sm-3 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat">Search</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Reservation Number</th>
                            <th>Room Number</th>
                            <th>Contact Name</th>
                            <th>Contact Phone Number</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th style="width: 40px"></th>
                        </tr>
                        <tr>
                            @foreach ($reservations as $reservation)
                                <td></td>
                                <td>{{ $reservation->reservation_number }}</td>
                                <td>{{ $reservation->room_number }}</td>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone_number }}</td>
                                <td>{{ $reservation->checkin_date }}</td>
                                <td>{{ $reservation->chackout_date }}</td>
                                <td>
                                    <a class="btn btn-app" href="{{ url('reservation/edit'. $reservation->id) }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a class="btn btn-app" href="{{ url('reservation/delete'. $reservation->id) }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                    <a class="btn btn-app" href="{{ url('reservation/checkout') }}">
                                        <i class="fa fa-sign-out"></i> Check Out
                                    </a>
                                </td>
                            @endforeach
                        </tr>
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
