<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/dashboard">Material Requirement Planning</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="/commodity"><i class="fa fa-fw fa-bar-chart-o"></i> Komoditas</a>
        </li>
        <li>
            <a href="/demand?date={{ date('Y-m-d') }}"><i class="fa fa-fw fa-table"></i> Pesanan </a>
        </li>
        <li>
            <a href="/forecast"><i class="fa fa-fw fa-edit"></i> Forecast </a>
        </li>
        <li>
            <a href="/mrp"><i class="fa fa-fw fa-edit"></i> MRP </a>
        </li>
        <li>
            <a href="/outlet"><i class="fa fa-fw fa-desktop"></i> Outlet</a>
        </li>
        <li>
            <a href="/bom"><i class="fa fa-fw fa-gear"></i> BOM </a>
        </li>
        <li>
            <a href="/packaging"><i class="fa fa-fw fa-wrench"></i> Bahan Kemas </a>
        </li>
         
    </ul>
</div>
</nav>