@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Check Out</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form role="form">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <label>Payment</label>
                                    <input type="text" class="form-control" name="total_price" value="" id="input_reservation_numper" placeholder="Reservation Number">
                                </div>
                                <div class="form-group">
                                    <label>Pembayaran</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="payment" value="Tunai" id="input_contact_name">Tunai
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="contact_name" value="Kredit" id="input_contact_name" >Kredit
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Payment Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                            <input type="text" class="form-control pull-right" id="payment_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Paid by</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio"  name="payment" value="Tunai" id="input_contact_name">Self
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio"  name="contact_name" value="Kredit" id="input_contact_name" >Office
                                            </label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="room_number" value="" id="input_room_number" placeholder="Room Number">
                                </div>
                                <div class="form-group">
                                        <label>address</label>
                                        <input type="text" class="form-control" name="contact_phone_number" value="" id="input_contact_phone_number" placeholder="Contact Phone Number">
                                </div>
                                <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="check_out" value="" id="input_check_out" placeholder="Check Out">
                                </div>
                                <div class="form-group">
                                        <label>Check Out Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            <input type="text" class="form-control pull-right" id="checkout_date">
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                    <a href="{{ url ('reservation')}}" class="btn btn-warning">back</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

    <script>
    </script>
@stop





























