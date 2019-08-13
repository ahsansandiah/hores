<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <!-- <img src="" class="img-circle" alt="" /> -->
            <img src="http://localhost:8000/logo.png" alt="" class="img-circle" style="width: 153px;">
        </div>
        <div class="pull-left info">
            <p>Hello, {{ Auth::user()->name }}</p>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->

    @include('partials.left-side-menu-admin')

</section>
<!-- /.sidebar -->
    