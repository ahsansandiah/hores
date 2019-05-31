@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservation Detail</h3>
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
                            <p class="lead"><b> Contact Identity </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Identity Number :</th>
                                        <td>{{ $reservation->type_identity_card }} | {{ $reservation->identity_card }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Name :</th>
                                        <td>{{ $reservation->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number : </th>
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
                            <p class="lead"><b> Description Reservation </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Check In :</th>
                                        <td>{{ $reservation->checkin_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Check Out :</th>
                                        <td>{{ $reservation->checkout_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration :</th>
                                        <td>{{ $reservation->duration }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Guest :</th>
                                        <td>{{ $reservation->adult_guest + $reservation->child_guest }}</td>
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
                            <p class="lead"><b> Pricing Reservation </b></p>
                            <div class="table-responsive">
                                <table class="table">
                                <tr>
                                    <th style="width:50%">Base Price :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->base_price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Service Tip</th>
                                    <td>{{  number_format($reservation->reservationCost->service_tip, 0, ',', '.') .' (%)' }}</td>
                                </tr>
                                <tr>
                                    <th>Tax :</th>
                                    <td>{{ number_format($reservation->reservationCost->tax, 0, ',', '.') .' (%)' }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->deposit, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit :</th>
                                    <td>{{ number_format($reservation->reservationCost->discount, 0, ',', '.')  .' (%)' }}</td>
                                </tr>
                                <tr>
                                    <th>Total :</th>
                                    <td>{{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') }}</td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                          
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="{{ url('reservation/edit/'.$reservation->id) }}" class="btn btn-default">Edit</a>
                            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                            @if ($reservation->status == $reservation::STATUS_CHECKIN)
                                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#payment-method"><i class="fa fa-credit-card"></i> Payment Method </a>
                            @endif
                            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button>
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





























