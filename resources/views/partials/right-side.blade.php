<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <small>{{ isset($url) ? $url : "Home" }}</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if (Session::get('message'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>Success!</b> {{ Session::get('message') }}
                </div>
                @elseif (Session::get('error_message'))
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>Error!</b> {{ Session::get('error_message') }}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</section><!-- /.content -->