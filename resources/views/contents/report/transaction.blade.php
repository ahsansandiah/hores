@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Transaksi</h3>
                    {{-- <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="customer" class="form-control pull-right" placeholder="Id Pelanggan">
                            <input type="text" name="transaction_number" class="form-control pull-right" placeholder="No Reservasi">
        
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">
                        <form method="GET" action="{{ url('report/transaction') }}" class="form-horizontal">
                            <div class="box-body">
                                <div class="input-group input-daterange">
                                    <input id="startDate" name="start_date" type="text"
                                        class="form-control" readonly="readonly" value="{{ old('start_date') }}"> <span
                                        class="input-group-addon"> <span
                                        class="glyphicon glyphicon-calendar"></span>
                                    </span> <span class="input-group-addon">S/D</span> <input id="end_date"
                                        name="endDate" type="text" class="form-control" readonly="readonly" value="{{ old('end_date') }}">
                                    <span class="input-group-addon"> <span
                                        class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="inputNameCustomer" class="col-sm-3 control-label">Pelanggan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputNameCustomer" value="{{ old('customer') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputReservationNumber" class="col-sm-3 control-label">No Reservasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="reservation_number" class="form-control" id="inputReservationNumber" value="{{ old('reservation_number') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer"> 
                                <button type="submit" class="btn btn-info pull-right">Filter</button>
                                <button type="submit" name="print" class="btn btn-success pull-right" style="margin-right: 4px;" onclick="setType('print')">Print</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <div>
                        <table class="table table-hover">
                            <tbody>
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
                                            <a class="btn btn-app" href="{{ url('reservation/detail/'.$reservation->reservation_number) }}">
                                                <i class="fa fa-address-card"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endsection