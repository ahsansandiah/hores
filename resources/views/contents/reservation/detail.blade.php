@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Reservasi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> {{ $room->room_number }}
                            <small class="pull-right">{{ $reservation->date }}</small>
                        </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><b> Identitas Customer </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">No Identitas :</th>
                                        <td>{{ $reservation->type_identity_card }} | {{ $reservation->identity_card }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Nama :</th>
                                        <td>{{ $reservation->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon : </th>
                                        <td>{{ $reservation->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th>
                                        <td>{{ $reservation->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><b> Deskripsi Reservasi </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Tanggal Check In :</th>
                                        <td>{{ $reservation->checkin_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Check Out :</th>
                                        <td>{{ $reservation->checkout_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Durasi :</th>
                                        <td>{{ $reservation->duration }} Hari</td>
                                    </tr>
                                    <tr>
                                        <th>Total Customer :</th>
                                        <td>{{ $reservation->adult_guest + $reservation->child_guest }} Orang</td>
                                    </tr>
                                    <tr>
                                        <th>Status :</th>
                                        <td>{{ $reservation->status }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><b> Biaya Reservasi </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                <tr>
                                    <th style="width:50%">Harga Sewa /hari :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->base_price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tip jasa</th>
                                    <td>{{  number_format($reservation->reservationCost->service_tip, 0, ',', '.') .'' }}</td>
                                </tr>
                                <tr>
                                    <th>Pajak :</th>
                                    <td>{{ $reservation->reservationCost->tax_percent.' (%)' }}</td>
                                </tr>
                                <tr>
                                    <th>Diskon :</th>
                                    <td>{{ $reservation->reservationCost->discount_percent.' (%)' }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->deposit, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Biaya Tambahan :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->total_additional_cost, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    @if ($reservation->reservationCost->underpayment == 0)
                                        <th>Kekurangan Bayar :</th>
                                        <td><b> {{ 'Rp. ' . number_format($reservation->reservationCost->underpayment, 0, ',', '.') }} (Lunas) </b></td>
                                    @else
                                        <th>Kekurangan Bayar :</th>
                                        <td><b>{{ 'Rp. ' . number_format($reservation->reservationCost->underpayment, 0, ',', '.') }}<b></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Total :</th>
                                    <td><b>{{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') }}</b></td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <hr>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                            <b>Biaya Tambahan</b>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <th>Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Total Harga</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    @foreach ($reservationAdditionalCosts as $additionalCost)
                                        <tr>
                                            <td>{{ $additionalCost->name }}</td>
                                            <td>{{ $additionalCost->quantity }}</td>
                                            <td>{{ $additionalCost->discount_percent }}</td>
                                            <td>{{ $additionalCost->price }}</td>
                                            <td>{{ $additionalCost->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                          
                    <hr>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                            @if ($reservation->status == $reservation::STATUS_CHECKIN)
                                <a href="{{ url('reservation/edit/'.$reservation->id) }}" class="btn btn-default">Edit</a>
                                <a class="btn btn-success pull-right" href="{{ url('reservation/check-out/'.$reservation->reservation_number ) }}"><i class="fa fa-credit-card"></i> Checkout </a>
                            @endif
                            {{-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Cetak
                            </button> --}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create Room --}}
    <div class="modal fade" id="payment-method">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Payment Method</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('reservation/check-out/'.$reservation->reservation_number ) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Price Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="price_total" id="inputRoomNumber" value="{{ $reservation->total_price }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Payment Type</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payment_type" id="optionsRadios1" value="tunai" checked="">Tunai
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="payment_type" id="optionsRadios2" value="credit" checked="">Kredit
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Checkout Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="checkout_date" id="inputCheckoutDate" value="{{ $reservation->checkout_date }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Payment Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="payment_date" id="inputPaymentDate" value="{{ $reservation->checkout_date }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Paid By</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="paid_by" id="optionsPaidBy1" value="personal" checked="">Personal
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="paid_by" id="optionsPaidBy2" value="institute" checked="">Institute
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Identity ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="identity_id" id="inputIdentityId" value="{{ $reservation->identity_id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="institute" id="inputName" value="{{ $reservation->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Address 1</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address_first" id="inputAddress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoomNumber" class="col-sm-2 control-label">Address 2</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address_second" id="inputInstituteAddressFirst">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info pull-right">Save</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop





























