<ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>

    @if (isset($menu_sidebar) && $menu_sidebar)
        @foreach ($menu_sidebar as $ms)
            @if (count($ms->children) > 0)
                <li class="treeview">
                    <a href="#">
                        <i class="{{ $ms->icon }}"></i>
                        <span>{{ $ms->name }}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="">
                        @foreach ($ms->children as $child)
                            <li><a href="{{ url($child->route) }}">
                                <i class="{{ $child->icon }}"></i> {{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ url(empty($ms->route) ? '/' : $ms->route) }}">
                        <i class="{{ $ms->icon }}"></i>
                        <span>{{ $ms->name }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    @endif
    <li style="treeview">
        <a href="{{ Url::to('/') }}">
            <i class="fa fa-puzzle-piece"></i>
            <span>Beranda</span>
        </a>
    </li>
    <li style="treeview">
        <a href="{{ Url::to('reservation') }}">
            <i class="fa fa-calendar"></i>
            <span>Reservasi</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bed"></i>
            <span>Ruangan</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="">
            <li><a href="{{ Url::to('room') }}"><i class="fa fa-hotel"></i> Ruangan</a></li>
            <li><a href="{{ url('room/type') }}"><i class="fa fa-bed"></i> Tipe Ruangan</a></li>
            <li><a href="{{ url('room/bed-type') }}"><i class="fa fa-circle-o-notch"></i> Tipe Ranjang</a></li>
            <li><a href="{{ url('room/condition') }}"><i class="fa fa-check-square"></i> Kondisi Ruangan</a></li>
        </ul>
    </li>
    <li style="treeview">
        <a href="{{ Url::to('service') }}">
            <i class="fa fa-cog"></i>
            <span>Service Tambahan</span>
        </a>
    </li>
    @if (Auth::user()->hasRole(['admin']))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="">
                <li><a href="{{ url('admin/roles') }}"><i class="fa fa-users"></i> Hak Akses</a></li>
                <li><a href="{{ url('admin/menus') }}"><i class="fa fa-list"></i> Menu</a></li>
                <li><a href="{{ url('admin/actions') }}"><i class="fa fa-key"></i> Actions</a></li>
            </ul>
        </li>
        <li style="treeview">
            <a href="{{ Url::to('admin/users') }}">
                <i class="fa fa-users"></i>
                <span>User</span>
            </a>
        </li>
    @endif

    @if (Auth::user()->hasRole(['admin']))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="">
                <li><a href="{{ url('report/transaction') }}"><i class="fa fa-file"></i> Transaksi</a></li>
            </ul>
        </li>
    @endif
</ul>
    