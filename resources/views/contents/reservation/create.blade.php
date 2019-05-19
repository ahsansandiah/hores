@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservation</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form role="form">
                            <div class="col-sm-3 pull-left">
                                <div>
                                    <label>
                                        <h3>
                                            Room Number
                                        </h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4 pull-left">
                                <div class="form-group">
                                    <label>Operator</label>
                                        <input type="text" class="form-control" name="reservation_number" value="" id="input_reservation_numper" placeholder="Reservation Number">
                                </div>
                            </div>
                            <div class="col-sm-3 pull-left">
                                <div class="form-group">
                                    <label>Faktur Number</label>
                                        <input type="text" class="form-control" name="reservation_number" value="" id="input_reservation_numper" placeholder="Reservation Number">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <form role="form">
                            <div class="col-sm-3 pull-left">
                                <div class="form-group">
                                    <label>Reservation Date</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Bed Type</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Check in Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                            <input type="text" class="form-control pull-right" id="checkin_date">
                                    </div>
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
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="number" value="1" min="0" max="1000" step="1"/>
                                </div>
                            </div>
                            <div class="col-sm-4 pull-left">
                                <div class="form-group">
                                    <label>Identity Card</label>
                                </div>
                                <div class="form-inline">
                                    <select class="form-control">
                                        <option>KTP</option>
                                        <option>SIM</option>
                                        <option>PASSPOR</option>
                                    </select>
                                    <select class="form-control">
                                        <option>MR.</option>
                                        <option>MRS.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                
                            </div>
                            <div class="col-sm-3 pull-left">
                                <div class="form-group">
                                    <label>Adult</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Child</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Job</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Price / Day</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                                <div class="form-group">
                                    <label>Total Price</label>
                                    <input type="text" class="form-control" name="contact_name" value="" id="input_contact_name" placeholder="contact Name">
                                </div>
                            </div>
                        </form>
                    </div> 
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Condensed Full Width Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>ID Menu</th>
                                  <th>Category</th>
                                  <th>Room Service</th>
                                  <th>QTY</th>
                                  <th>Price</th>
                                  <th>Total Price</th>
                                </tr>
                                <tr>
                                  <td>1.</td>
                                  <td>1001</td>
                                  <td>Laundry</td>
                                  <td>1</td>
                                  <td>50000</td>
                                  <td>.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                    <a href="" class="btn btn-success pull-left" data-toggle="modal" data-target="#modal-default">Add Service</a>
                    <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Form Add Service</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('service/store') }}" method="POST" class="form-horizontal">
                                            @csrf
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="code" class="col-sm-2 control-label">Code</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="code" placeholder="Code Product">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="Name" placeholder="Name Product">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control">
                                                            <option>Laundry</option>
                                                            <option>Food</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="piece" class="col-sm-2 control-label">piece</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="piece" placeholder="price at piece">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock" class="col-sm-2 control-label">stock</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="stock" placeholder="stock">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="buy price" class="col-sm-2 control-label">buy price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="buy_price" placeholder="Buy price">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sell_preice" class="col-sm-2 control-label">Sell Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="sell_price" placeholder="Sell Price">
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
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop





























