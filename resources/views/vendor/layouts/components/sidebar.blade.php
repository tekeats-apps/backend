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
                    <a class="nav-link menu-link {{ Route::is('vendor.dashboard.index') ? 'active' : '' }}" href="{{ route('vendor.dashboard.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboard')</span>
                    </a>
                </li>
                <li class="menu-title"><span>Orders Management</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="ri-shopping-basket-2-line"></i> <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.customers.list') ? 'active' : '' }}" href="{{ route('vendor.customers.list') }}">
                        <i class="ri-account-circle-fill text-green"></i> <span>Customers</span>
                    </a>
                </li>
                <li class="menu-title"><span>Products Management</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.categories.list') ? 'active' : '' }}" href="{{ route('vendor.categories.list') }}">
                        <i class=" ri-copper-coin-line"></i> <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.products.list') ? 'active' : '' }}" href="{{ route('vendor.products.list') }}">
                        <i class="ri-shopping-bag-line"></i> <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.tags.list') ? 'active' : '' }}" href="{{ route('vendor.tags.list') }}">
                        <i class="ri-price-tag-3-fill"></i> <span>Tags</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="ri-coupon-line"></i> <span>Copouns</span>
                    </a>
                </li>
                <li class="menu-title"><span>User Management</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="ri-takeaway-fill"></i> <span>Riders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.roles.list') ? 'active' : '' }}" href="{{ route('vendor.roles.list') }}">
                        <i class="ri-swap-line"></i> <span>Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('vendor.users.list') ? 'active' : '' }}" href="{{ route('vendor.users.list') }}">
                        <i class="ri-account-circle-fill"></i> <span>@lang('translation.users')</span>
                    </a>
                </li>
                <li class="menu-title"><span> System</span></li>
                <li class="nav-item">
                    <a href="#sidebarSettings" class="nav-link {{ Route::is('vendor.settings.*') ? 'active' : 'collapsed' }}" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSettings">Settings
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('vendor.settings.*') ? 'show' : '' }}" id="sidebarSettings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('vendor.settings.system') }}" class="nav-link {{ Route::is('vendor.settings.system') ? 'active' : '' }}">System
                                    Settings</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vendor.settings.opening.hours') }}" class="nav-link {{ Route::is('vendor.settings.opening.hours') ? 'active' : '' }}"> Opening Hours</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="menu-title"><span> Store</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="ri-tools-line"></i> <span>Plugins</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
