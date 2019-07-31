@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Checkin | {{ $room->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/check-in/'. $room->room_number .'/store') }}">
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
                                    <input type="text" class="form-control" name="reservation_number" value="{{ $reservationNumber }}" id="input_reservation_numper" placeholder="No Reservasi">
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
                                    <input type="text" class="form-control" name="identity_number" id="input_contact_name" placeholder="No Identitas">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" id="input_contact_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="address" id="input_contact_name" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="job" id="input_contact_name" placeholder="Job">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Checkin</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkin_date" class="form-control pull-right inputCheckin" id="checkin_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Checkout</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" class="form-control pull-right inputCheckout" id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Hari</label>
                                    <input type="number" name="duration" id="inputDuration" class="form-control pull-right" value="1" min="0" max="1000" step="1"/>
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
                                    <label>Keterangan</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" style="height: 80px;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Sewa / Hari</label>
                                    <input type="text" class="form-control" name="price_day" id="inputPriceDay" value="{{ number_format($room->price_day, 0, ',', '.') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Total Harga Sewa</label>
                                    <input type="text" class="form-control" name="total_price_view" id="inputTotalPriceView" value="">
                                    <input type="hidden" class="form-control" name="total_price" id="inputTotalPrice" value="">
                                </div>
                                <div class="form-group">
                                    <label>Jasa Service</label>
                                    <input type="text" class="form-control" name="service_tip" id="input_contact_name" placeholder="Service Tip">
                                </div>
                                <div class="form-group">
                                    <label>Pajak</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="tax_percent" id="inputTaxPercent" placeholder="%">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="tax_view" id="inputTaxView">
                                            <input type="hidden" class="form-control" name="tax" id="inputTax" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="discount_percent" id="inputDiscountPercent" placeholder="%">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="discount_view" id="inputDiscountView" value="">
                                            <input type="hidden" class="form-control" name="discount" id="inputDiscount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" class="form-control" name="total" id="totalPrice" placeholder="Jumlah" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="inputDeposit" placeholder="Deposit">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-additional-cost">Biaya tambahan</a><p></p>
                                <table class="table table-bordered">
                                    <tbody id="showdata">
                                        <tr>
                                            <th>Titel</th>
                                            <th style="width: 40px">Jumlah</th>
                                            <th>Harga</th>
                                            <th style="width: 40px">Diskon (%)</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        @if (!empty($additionalServiceCache))
                                            @foreach ($additionalServiceCache as $serviceCache)
                                            <tr>
                                                <td>
                                                    {{ $serviceCache['service'] }}
                                                </td>
                                                <td>
                                                    {{ $serviceCache['quantity'] }}
                                                </td>
                                                <td>
                                                    {{ $serviceCache['price'] }}
                                                </td>
                                                <td>
                                                    {{ $serviceCache['discount'] }}
                                                </td>
                                                <td>
                                                    {{ $serviceCache['description'] }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
                        <a href="{{ url('/reservation') }}" class="btn btn-block btn-primary btn-lg">cancel</a>
                    </div>
                </form>
                <!-- /.box-footer -->
                <div class="modal fade" id="modal-additional-cost">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form biaya tambahan</h4>
                            </div>
                            {{-- action="{{ url('reservation/add-additional-services/'.$room->room_number) }}" --}}
                            <div class="modal-body">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label>Service Tambahan</label>
                                    <div class="form-inline">
                                        <select class="form-control services" name="additional_service" id="inputService">
                                            @foreach ($additionalServices as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" class="form-control" name="quantity" id="inputQuantity" placeholder="Jumlah">
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="service_price" id="inputServicePrice">
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="service_discount_percent" id="inputserviceDiscountPercent" placeholder="%">
                                        </div>
                                        <div class="col-md-8">
                                            {{-- <input type="text" class="form-control" name="service_discount" id="inputServiceDiscount" value=""> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="service_price" id="inputServiceDescription">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-block btn-success btn-lg add-additional-cost" id="addAdditionalServices">Tambah</button>
                            </div>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $('#inputDuration').on('change', function(){
                total_price = $(this).val() * {{ $room->price_day }}
                $('#inputTotalPrice').val(total_price);
                $('#inputTotalPriceView').val(total_price).formatCurrency({ region: 'id-ID' });
            })

            $('#inputDuration').change();

            // Discount
            $('#inputDiscountPercent').on('change', function(){
                total_discount = ($(this).val() / 100) * {{ $room->price_day }}
                $('#inputDiscount').val(total_discount);
                $('#inputDiscountView').val(total_discount).formatCurrency({ region: 'id-ID' });
            })

            $('#inputDiscountPercent').change();

            // Tax
            $('#inputTaxPercent').on('change', function(){
                total_tax = ($(this).val() / 100) * {{ $room->price_day }}
                $('#inputTax').val(total_tax);
                $('#inputTaxView').val(total_tax).formatCurrency({ region: 'id-ID' });
            })

            $('#inputTaxPercent').change();

            // Total Price
            $('#inputDiscountPercent').on('change', function(){
                var totalSewa = $('#inputTotalPrice').val()
                var totalTax = $('#inputTax').val()
                var totalDiscount = $('#inputDiscount').val()
                var total = (parseInt(totalSewa) + parseInt(totalTax)) - parseInt(totalDiscount)
                console.log(total)
                $('#totalPrice').val(total).formatCurrency({ region: 'id-ID' });;
            })

            $('#totalPrice').change();

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

            // Duration
            $('#inputDuration').on('click', function(){
                var start = new Date(document.getElementById("checkin_date").value);
    	        var end = new Date(document.getElementById("checkout_date").value);
                days = (end.getTime() - start) / (1000 * 60 * 60 * 24);
                console.log(days)
                $('#inputDuration').val(parseInt(days));
            })
            $('#inputDuration').change();

        </script>
    @endsection
@stop