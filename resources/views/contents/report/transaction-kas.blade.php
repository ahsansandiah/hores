@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan KAS</h3>
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
                        <form method="GET" action="{{ url('report/kas') }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-sm-12">
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
                                    <th class="service">No</th>
                                    <th class="desc">Tanggal</th>
                                    <th>No Faktur</th>
                                    <th>Keterangan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                                @php($no = 1)
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $reservation->checkin_date }}</td>
                                        <td>{{ $reservation->reservation_number }}</td>
                                        <td>{{ $reservation->description }}</td>
                                        <td>
                                            @if (!is_null($reservation->reservationCost))
                                                @if ($reservation->reservationCost->payment_type == "Tunai")
                                                    {{ $reservation->total_price }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($reservation->reservationCost))
                                                @if ($reservation->reservationCost->payment_type == "Kredit")
                                                    {{ $reservation->total_price }}
                                                @endif
                                            @endif
                                        </td>
                                        <td></td>
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