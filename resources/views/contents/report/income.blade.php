@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Pendapatan</h3>
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
                    <div class="col-md-4">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    {{ 'Rp. ' . number_format($totalIncome, 0, ',', '.') }}
                                </h3>
                    
                                <p>Total Pendapatan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ url('report/income/print/all') }}" class="small-box-footer">Cetak Detail Pendapatan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    {{ 'Rp. ' . number_format($incomeLastMonth, 0, ',', '.') }}
                                </h3>
                    
                                <p>Total Pendapatan Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ url('report/income/print/monthly') }}" class="small-box-footer">Cetak Detail Pendapatan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>
                                    {{ 'Rp. ' . number_format($incomeBeforeLastMonth, 0, ',', '.') }}
                                </h3>
                    
                                <p>Total Pendapatan Bulan Lalu</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ url('report/income/print/monthly') }}" class="small-box-footer">Cetak Detail Pendapatan <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('style')
    <link rel="stylesheet" href='{{ url('adminLTE/bower_components/morris.js/morris.css') }}'>
@endsection
@section('script')
    <link rel="stylesheet" href='{{ url('adminLTE/bower_components/raphael/raphael.min.js') }}'>
    <link rel="stylesheet" href='{{ url('adminLTE/bower_components/morris.js/morris.min.js') }}'>
    <link rel="stylesheet" href='{{ url('adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js') }}'>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    {!! $chart->script() !!}
@endsection