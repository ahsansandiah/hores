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
                                    <label>Faktur Number</label>
                                    <input type="text" class="form-control" name="reservation_number" id="input_reservation_numper" placeholder="Reservation Number">
                                </div>
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <input type="text" class="form-control" name="contact_name" id="input_contact_name" value="{{ $room->roomType->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Bed Type</label>
                                    <input type="text" class="form-control" name="contact_name" value="{{ $room->roomBedType->name }}" id="input_contact_name" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Check in Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkin_date" class="form-control pull-right" id="checkin_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Check Out Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="checkout_date" class="form-control pull-right" id="checkout_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="number" name="duration" class="form-control pull-right" value="1" min="0" max="1000" step="1"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Identity Card</label>
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
                                    <label>Identity Number</label>
                                    <input type="text" class="form-control" name="identity_number" id="input_contact_name" placeholder="Identity Number">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="input_contact_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" id="input_contact_name" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" id="input_contact_name" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="input_contact_name" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>Adult</label>
                                    <input type="text" class="form-control" name="adult" id="input_contact_name" placeholder="Adult Total">
                                </div>
                                <div class="form-group">
                                    <label>Child</label>
                                    <input type="text" class="form-control" name="child" id="input_contact_name" placeholder="Child Total">
                                </div>
                                <div class="form-group">
                                    <label>Job</label>
                                    <input type="text" class="form-control" name="job" id="input_contact_name" placeholder="Job">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Price / Day</label>
                                    <input type="text" class="form-control" name="price_day" id="input_contact_name" placeholder="Price /day">
                                </div>
                                <div class="form-group">
                                    <label>Service Tip</label>
                                    <input type="text" class="form-control" name="service_tip" id="input_contact_name" placeholder="Service Tip">
                                </div>
                                <div class="form-group">
                                    <label>Tax</label>
                                    <input type="text" class="form-control" name="tax" id="input_contact_name" placeholder="Tax %">
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="text" class="form-control" name="discount" id="input_contact_name" placeholder="Discount %">
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="input_contact_name" placeholder="Deposit">
                                </div>
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
@stop





























