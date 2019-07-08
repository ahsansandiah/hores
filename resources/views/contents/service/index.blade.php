@extends('layouts.main')
@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Biaya Tambahan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3 pull-left">
                                <div class="input-group margin">
                                    <a href="" class="btn btn-block btn-success btn-flat"  data-toggle="modal" data-target="#modal-default">Tambah</a>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Form Biaya Tambahan</h4>
                                                    <div class="modal-body">
                                                        <form action="{{ url('service/store') }}" method="POST" class="form-horizontal">
                                                            @csrf
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="code" class="col-sm-2 control-label">Kode Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="code" id="code" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Kategori</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="category">
                                                                            <option value="service">Jasa</option>
                                                                            <option value="kitchen">Makanan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="piece" class="col-sm-2 control-label">Harga</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="price" id="price" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stock" class="col-sm-2 control-label">Stok</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="stock" id="stock" placeholder="stock">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-10">
                                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Keluar</button>
                                                                        <button type="submit" class="btn btn-primary pull-left">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        <!-- /.modal-content -->
                                        </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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
                            @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->category }}</td>
                                <td>{{ $service->stock }}</td>
                                <td>{{ $service->price }}</td>
                                {{-- <td>{{ $service->description }}</td> --}}
                                <td>
                                    <a class="btn btn-app" href="" data-toggle="modal" data-target="#modal-edit{{ $service->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <div class="modal fade" id="modal-edit{{ $service->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Form ubah Biaya Tambahan</h4>
                                                    <div class="modal-body">
                                                        <form action="{{ url('service/update/'.$service->id) }}" method="POST" class="form-horizontal">
                                                            @csrf
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="code" class="col-sm-2 control-label">Kode Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="code" id="code" value="{{ $service->code }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="name" id="name" value="{{ $service->name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 control-label">Kategori</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="category">
                                                                            <option value="service" {{ ($service->category == "service") ? "selected" : "" }}>Jasa</option>
                                                                            <option value="kitchen" {{ ($service->category == "kitchen") ? "selected" : "" }}>Makanan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="piece" class="col-sm-2 control-label">Harga</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="price" id="price" value="{{ $service->price }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stock" class="col-sm-2 control-label">Stok</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="stock" id="stock" value="{{ $service->stock }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button> --}}
                                                </div>
                                            </div>
                                        <!-- /.modal-content -->
                                        </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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
                        {{ $services->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
@stop
