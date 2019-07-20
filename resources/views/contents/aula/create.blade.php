@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Aula</h3>
                </div>
                <!-- /.box-header -->
                <form method="POST" action="{{ url('/aula/store') }}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Aula</label>
                                    <input type="text" class="form-control" name="number" id="" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category" required>
                                        <option value="Aula 1">Aula 1</option>
                                        <option value="Aula 2">Aula 2</option>
                                        <option value="Aula 3">Aula 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga Sewa</label>
                                    <input type="text" class="form-control" name="price_day" id="" required>
                                </div>
                                <div class="form-group">
                                    <label>Maksimal orang</label>
                                    <input type="text" class="form-control" name="guest_total" id="" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" style="height: 80px;"></textarea>                                    
                                </div>
                                <div class="form-group">
                                    <label>Aktif</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <select class="form-control" name="condition">
                                        <option value="1">Baik</option>
                                        <option value="2">Renovasi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-success btn-lg add-additional-cost">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
