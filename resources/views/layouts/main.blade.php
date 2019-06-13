<!DOCTYPE html>
<html lang="en" ng-app="myApp">
    <head>
        @include('partials.meta')
        @include('partials.style')
        @yield('style')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                @include('partials.header')
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                @include('partials.left-side')
            </aside>

            <div class="content-wrapper">
                @include('partials.right-side')
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.1
                </div>
                <strong>Copyright &copy; 2019 <a href="#">Hotel Reservasi</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        
        @include('partials.script')
        @yield('script')
    </body>
</html>