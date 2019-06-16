<ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>
    <li style="treeview">
        <a href="{{ Url::to('/') }}">
            <i class="fa fa-puzzle-piece"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li style="treeview">
        <a href="{{ Url::to('reservation') }}">
            <i class="fa fa-calendar"></i>
            <span>Reservation</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bed"></i>
            <span>Rooms</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="">
            <li><a href="{{ Url::to('room') }}"><i class="fa fa-hotel"></i> Rooms</a></li>
            <li><a href="{{ url('room/type') }}"><i class="fa fa-bed"></i> Room Type</a></li>
            <li><a href="{{ url('room/bed_type') }}"><i class="fa fa-circle-o-notch"></i> Bed Type</a></li>
            <li><a href="{{ url('room/condition') }}"><i class="fa fa-check-square"></i> Condition</a></li>
        </ul>
    </li>
    <li style="treeview">
        <a href="{{ Url::to('service') }}">
            <i class="fa fa-cog"></i>
            <span>Additional Services</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Config</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="">
            <li><a href="{{ url('admin/roles') }}"><i class="fa fa-users"></i> Roles</a></li>
            <li><a href="{{ url('admin/menus') }}"><i class="fa fa-list"></i> Menus</a></li>
            <li><a href="{{ url('admin/actions') }}"><i class="fa fa-key"></i> Actions</a></li>
        </ul>
    </li>
    <li style="treeview">
        <a href="{{ Url::to('admin/users') }}">
            <i class="fa fa-users"></i>
            <span>Users</span>
        </a>
    </li>
</ul>
    