@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi Aula</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/aula/reservation/'. $aula->id .'/store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <input type="text" class="form-control" name="operator" id="input_reservation_numper" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>No Indentitas</label>
                                    <input type="text" class="form-control" name="identity_card" id="input_contact_name" placeholder="No Identitas">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" id="input_contact_name" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="address" id="input_contact_name" placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="city" id="input_contact_name" placeholder="Kota">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" placeholder="No Telepon">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="input_contact_name" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No Reservasi</label>
                                    <input type="text" class="form-control" name="reservation_aula_number" value="{{ $generateReservationNumber }}" id="input_reservation_numper" placeholder="No Reservasi">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Checkin</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkin_date" class="form-control pull-right" id="checkin_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Checkout</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" class="form-control pull-right" id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Hari</label>
                                    <input type="number" name="duration" id="inputDuration" class="form-control pull-right" value="1" min="0" max="1000" step="1"/>
                                </div>
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="number" name="total_price" id="inputTotal" class="form-control pull-right" />
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
                        <a href="{{ url('/aula') }}" class="btn btn-block btn-primary btn-lg">cancel</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $('#inputDuration').on('change', function(){
                total_price = $(this).val() * {{ $aula->price_day }}
                $('#inputTotal').val(total_price);
            })

            $('#inputDuration').change();
        </script>
    @endsection
@stop