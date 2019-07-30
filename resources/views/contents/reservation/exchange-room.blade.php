@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Pindah Kamar | {{ $reservation->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/exchange-room/'. $reservation->reservation_number . '/process') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Kamar</label>
                                    <select name="room" id="selectRoom" class="form-control">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->room_number }}">{{ $room->room_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga Sewa /hari</label>
                                    <input type="text" class="form-control" name="price" id="inputPrice">
                                </div>
                                <div class="form-group">
                                    <label>Diskon (%)</label>
                                    <input type="text" class="form-control" name="discount" id="inputPrice" value="{{ $reservation->reservationCost->discount_percent }}">
                                </div>
                                <div class="form-group">
                                    <label>Pajak (%)</label>
                                    <input type="text" class="form-control" name="tax" id="inputPrice" value="{{ $reservation->reservationCost->tax_percent }}">
                                </div>
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" class="form-control" name="deposit" id="inputPrice" value="{{ $reservation->reservationCost->deposit }}">
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
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Detail Pembayaran Sebelumnya</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Harga Sewa :</th>
                                        <td>{{ 'Rp. ' . number_format($reservation->price_day, 0, ',', '.') . " /hari" }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Total :</th>
                                        <td>{{ 'Rp. ' . number_format($reservation->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        @if ($reservation->reservationCost->status == "paid")
                                            <th style="width:50%">Total Terbayar :</th>
                                            <td>{{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') . " (Lunas)" }}</td>
                                        @else
                                            <th style="width:50%">Total Kekurangan :</th>
                                            <td>{{ 'Rp. ' . number_format($reservation->reservationCost->underpayment, 0, ',', '.') }}</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="box-footer">
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#selectRoom').on('change', function() {
            @foreach ($rooms as $room)
                var roomNumber = "{{ $room->room_number }}"
                if (roomNumber == $(this).val()) {
                    console.log(roomNumber)
                    price = "{{ $room->price_day }}"
                    $('#inputPrice').val(price);
                }
            @endforeach
        })
        $('#inputPrice').change();
    </script>
@endsection





























