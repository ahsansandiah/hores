@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Checkin | {{ $room->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/update/'. $reservation->id) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>No Reservasi</label>
                                    <input type="text" class="form-control" name="reservation_number" value="{{ $reservation->reservation_number }}" id="input_reservation_numper" placeholder="No Reservasi">
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
                                    <input type="text" class="form-control" name="identity_number" value="{{ $reservation->identity_card }}" id="input_contact_name" placeholder="No Identitas">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{ $reservation->name }}" id="input_contact_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="address" value="{{ $reservation->address }}" id="input_contact_name" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="city" id="input_contact_name" value="{{ $reservation->city }}" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" value="{{ $reservation->phone_number }}" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="job" id="input_contact_name" value="{{ $reservation->job }}" placeholder="Job">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Checkin</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkin_date" value="{{ $reservation->checkin_date }}" class="form-control pull-right" id="checkin_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Checkout</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" value="{{ $reservation->checkout_date }}" class="form-control pull-right" id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Hari</label>
                                    <input type="number" name="duration" id="inputDuration" value="{{ $reservation->duration }}" class="form-control pull-right" value="1" min="0" max="1000" step="1"/>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Dewasa</label>
                                    <input type="text" class="form-control" name="adult" value="{{ $reservation->adult_guest }}" id="input_contact_name" placeholder="Adult Total">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Anak-anak</label>
                                    <input type="text" class="form-control" name="child" value="{{ $reservation->child_guest }}" id="input_contact_name" placeholder="Child Total">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="description" class="form-control" id="" value="{{ $reservation->description }}" cols="30" rows="10" style="height: 80px;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
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
                                    <input type="text" class="form-control" name="service_tip" value="{{ $reservation->reservationCost->service_tip }}" id="input_contact_name" placeholder="Service Tip">
                                </div>
                                <div class="form-group">
                                    <label>Pajak</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="tax_percent" value="{{ $reservation->reservationCost->tax_percent }}"  id="inputTaxPercent" placeholder="%">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="tax" value="{{ $reservation->reservationCost->tax }}"  id="inputTax">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="discount_percent" value="{{ $reservation->reservationCost->discount_percent }}"  id="inputDiscountPercent" placeholder="%">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="discount" value="{{ $reservation->reservationCost->discount }}"  id="inputDiscount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="input_contact_name" value="{{ $reservation->reservationCost->deposit }}"  placeholder="Deposit">
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


            // Service Discount
            $('#inputServiceDiscountPercent').on('change', function(){
                total_service_discount = ($(this).val() / 100) * $("#inputServicePrice").val()
                $('#inputServiceDiscount').val(total_service_discount);
            })

            $('#inputServiceDiscountPercent').change();

            // Add Additional Service
            $(document).ready(function(){
                $('.add-additional-cost').click(function(){
                    var service = $('#inputService option:selected').text();
                    var quantity = $('#inputQuantity').val();
                    var price = $('#inputServicePrice').val();
                    var discount = $('#inputserviceDiscountPercent').val();
                    var description = $('#inputServiceDescription').val();
                    var markup = "<tr>"+
                        "<td>"+
                            "<input type='hidden' name='service' value='"+ service +"'>" + service +
                        "</td>"+
                        "<td>"+
                            "<input type='hidden' name='quantity' value='"+ quantity +"'>" + quantity +
                        "</td>"+
                        "<td>"+
                            "<input type='hidden' name='price' value='"+ price +"'>" + price +
                        "</td>"+
                        "<td>"+
                            "<input type='hidden' name='discount' value='"+ discount +"'>" + discount +
                        "</td>"+
                        "<td>"+
                            "<input type='hidden' name='description' value='"+ description +"'>" + description +
                        "</td>"+
                        "<tr>"
                    $("#showdata").append(markup);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: '{{ url("reservation/add-additional-services/".$room->room_number) }}',
                        data: {
                            service:service,
                            quantity:quantity, 
                            price:price, 
                            discount:discount,
                            description:description
                        },
                        success: function( response ) {
                            console.log('success')
                        }
                    });
                });
            });
            // Find and remove selected table rows
            // $('#form-additional-service').on('submit', function(e) {
            //     e.preventDefault();

            //     var service = $('#inputService option:selected').text();
            //     var quantity = $('#inputQuantity').val();
            //     var price = $('#inputServicePrice').val();
            //     var discount = $('#inputserviceDiscountPercent').val();
            //     var description = $('#inputServiceDescription').val();

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: "post",
            //         url: '{{ url("reservation/add-additional-services/".$room->room_number) }}',
            //         data: {
            //             service:service,
            //             quantity:quantity, 
            //             price:price, 
            //             discount:discount,
            //             description:description
            //         },
            //         success: function( response ) {
            //             $("#showdata").html(
            //                 response
            //             );
            //         }
            //     });
            // });
        </script>
    @endsection
@stop