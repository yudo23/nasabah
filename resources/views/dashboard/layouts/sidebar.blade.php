<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">

            <a href="{{route('dashboard.index')}}" class="logo"><img src="{{URL::to('/')}}/templates/dashboard/assets/images/logo-dark.png" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard.index')}}" class="waves-effect active">
                        <i class="fa fa-tachometer"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.nasabah.index')}}" class="waves-effect active">
                        <i class="fa fa-user"></i>
                        <span> Nasabah</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.transaction.index')}}" class="waves-effect active">
                        <i class="fa fa-money"></i>
                        <span> Transaksi</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.point.index')}}" class="waves-effect active">
                        <i class="fa fa-money"></i>
                        <span> Point</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.report.index')}}" class="waves-effect active">
                        <i class="fa fa-file"></i>
                        <span> Report</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>