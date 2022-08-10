<a href="index3.html" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ Auth::user()->avatar }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ $nav_hover == 'dashboard' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.list') }}"
                    class="nav-link {{ $nav_hover == 'users' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.list') }}"
                    class="nav-link {{ $nav_hover == 'products' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.catalogs.list') }}"
                    class="nav-link {{ $nav_hover == 'catalogs' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Catalogs
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.transactions.list') }}"
                    class="nav-link {{ $nav_hover == 'orders' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                        Transactions
                    </p>
                </a>
            </li>

            <li class="nav-item d-flex justify-content-end">
                <a href="{{ route('logout') }}"
                    class="nav-link {{ $nav_hover == 'orders' ? ' active' : '' }}">
                    <i class="nav-icon fas fa-sign-out"></i>
                    <p>
                        Sign Out
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
