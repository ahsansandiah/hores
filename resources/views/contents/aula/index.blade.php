@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Aula</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3 pull-left">
                            <div class="input-group margin">
                                <a href="{{ url('aula/create') }}" class="btn btn-block btn-success btn-flat" >Tambah</a>
                            </div>
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
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            {{-- <th>Keterangan</th> --}}
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($aulas as $aula)
                        <tr>
                            <td>{{ $aula->number }}</td>
                            <td>{{ $aula->category }}</td>
                            <td>{{ $aula->price_day }}</td>
                            <td>{{ $aula->guest_total }}</td>
                            <td>
                                <a class="btn btn-app" href="{{ url('service/destroy/'. $service->id) }}">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $aulas->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
