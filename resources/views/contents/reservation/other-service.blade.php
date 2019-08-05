@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#modal-additional-cost">Biaya tambahan</a>
                        </div>
                        <table class="table table-bordered">
                            <tbody id="showdata">
                                <tr>
                                    <th>Titel</th>
                                    <th style="width: 40px">Jumlah</th>
                                    <th>Harga</th>
                                    <th style="width: 40px">Diskon (%)</th>
                                    <th>Total Bayar</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                                @if (!empty($reservation->reservationAdditionalCosts))
                                    @foreach ($reservation->reservationAdditionalCosts as $additionalCost)
                                    <tr>
                                        <td>
                                            {{ $additionalCost['name'] }}
                                        </td>
                                        <td>
                                            {{ $additionalCost['quantity'] }}
                                        </td>
                                        <td>
                                            {{ $additionalCost['base_price'] }}
                                        </td>
                                        <td>
                                            {{ $additionalCost['discount_percent'] }}
                                        </td>
                                        <td>
                                            {{ $additionalCost['price'] }}
                                        </td>
                                        <td>
                                            {{ $additionalCost['description'] }}
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-primary" data-toggle="modal" data-target="#modal-edit">Ubah</a> -->
                                            <a class="btn btn-primary" href="{{ url('/reservation/delete/additional-services/'.$additionalCost['id']) }}">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-footer -->
                <div class="modal fade" id="modal-additional-cost">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form biaya tambahan</h4>
                            </div>
                            <form action="{{ url('reservation/store/additional-services/'.$reservation->id) }}" method="post">
                                @csrf
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
                                        <input type="text" class="form-control" name="service_price" id="inputServicePriceView">
                                        <input type="hidden" class="form-control" name="service_price" id="inputServicePrice">
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
                                        <input type="text" class="form-control" name="description" id="inputServiceDescription">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-block btn-success btn-lg" id="addAdditionalServices">Tambah</button>
                                </div>
                            </form>
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
            // Deposit
            $('#inputServicePriceView').on('change', function(){
                var servicePrice = this.value;
                $('#inputServicePriceView').val(servicePrice).formatCurrency({ region: 'id-ID' });
                $('#inputServicePrice').val(servicePrice);
            })

            $('#inputServicePriceView').change();
            $('#inputServicePrice').change();
        </script>
    @endsection
@stop