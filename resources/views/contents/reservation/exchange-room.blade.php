@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservasi - Pindah Ruangan | {{ $reservation->room_number }}</h3>
                </div>
                <!-- /.box-header -->
                <form role="form" method="POST" action="{{ url('/reservation/update/'. $reservation->id) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

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





























