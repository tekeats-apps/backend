<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboard')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.order.list') }}">
                        <i class="bx bx-cart-alt"></i> <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.restaurant.list') }}">
                        <i class="ri-store-2-line"></i> <span>Restaurants</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.roles.list') }}">
                        <i class="ri-swap-line"></i> <span>Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.users.list') }}">
                        <i class="ri-account-circle-fill"></i> <span>@lang('translation.users')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/plans*') ? 'active' : '' }}" href="#sidebarPlans" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPlans">
                        <i class="ri-file-list-3-line"></i> <span>Plans</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->is('admin/plans*') ? 'show' : '' }}" id="sidebarPlans">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.plans.features.list') }}" class="nav-link {{ request()->routeIs('admin.plans.features.list') ? 'active' : '' }}">Features</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Subscriptions</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
