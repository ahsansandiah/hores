@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservation - Checkin | {{ $room->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/check-in/'. $room->room_number .'/store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>No Reserfasi</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" placeholder="Reservation Number">
                                </div>
                                <div class="form-group">
                                    <label>Tipe Ruangan</label>
                                    <input type="text" class="form-control" name="contact_name" id="input_contact_name" value="{{ $room->roomType->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Ranjang</label>
                                    <input type="text" class="form-control" name="contact_name" value="{{ $room->roomBedType->name }}" id="input_contact_name" disabled>
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
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Identitas</label>
                                    <div class="form-inline">
                                        <select class="form-control" name="type_identity_card">
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>PASSPOR</option>
                                        </select>
                                        <select class="form-control">
                                            <option>MR.</option>
                                            <option>MRS.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Indentitas</label>
                                    <input type="text" class="form-control" name="identity_number" id="input_contact_name" placeholder="Identity Number">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" id="input_contact_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="address" id="input_contact_name" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="city" id="input_contact_name" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Dewasa</label>
                                    <input type="text" class="form-control" name="adult" id="input_contact_name" placeholder="Adult Total">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Anak-anak</label>
                                    <input type="text" class="form-control" name="child" id="input_contact_name" placeholder="Child Total">
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="job" id="input_contact_name" placeholder="Job">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Harga Sewa / Hari</label>
                                    <input type="text" class="form-control" name="price_day" id="inputPriceDay" value="{{ number_format($room->price_day, 0, ',', '.') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Total Harga Sewa</label>
                                    <input type="text" class="form-control" name="total_price" id="inputTotalPrice" value="">
                                </div>
                                <div class="form-group">
                                    <label>Jasa Service</label>
                                    <input type="text" class="form-control" name="service_tip" id="input_contact_name" placeholder="Service Tip">
                                </div>
                                <div class="form-group">
                                    <label>Pajak</label>
                                    <input type="text" class="form-control" name="tax_percent" id="inputTaxPercent" placeholder="Tax %">
                                    <input type="text" class="form-control" name="tax" id="inputTax">
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <input type="text" class="form-control" name="discount_percent" id="inputDiscountPercent" placeholder="Discount %">
                                    <input type="text" class="form-control" name="discount" id="inputDiscount" value="">
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="input_contact_name" placeholder="Deposit">
                                </div>
                                {{-- <div class="form-group">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3 id="totalPrice"></h3>
                            
                                            <p>Total</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div> 
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
                        <a href="{{ url('/reservation') }}" class="btn btn-block btn-primary btn-lg">cancel</a>
                    </div>
                </form>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $('#inputDuration').on('change', function(){
                total_price = $(this).val() * {{ $room->price_day }}
                $('#inputTotalPrice').val(total_price);
            })

            $('#inputDuration').change();

            // Discount
            $('#inputDiscountPercent').on('change', function(){
                total_discount = ($(this).val() / 100) * {{ $room->price_day }}
                $('#inputDiscount').val(total_discount);
            })

            $('#inputDiscountPercent').change();

            // Tax
            $('#inputTaxPercent').on('change', function(){
                total_tax = ($(this).val() / 100) * {{ $room->price_day }}
                $('#inputTax').val(total_tax);
            })

            $('#inputTaxPercent').change();

            // Total Price
            total_price = ($('#inputTotalPrice').val() + $('#inputTax').val()) - $('#inputDiscount').val()
            console.log(total_price)
            $('#totalPrice').text(total_price);
        </script>
    @endsection
@stop





























