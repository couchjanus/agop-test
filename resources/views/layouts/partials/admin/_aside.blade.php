<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Admin Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.dashboard") }}" class="nav-link">
                        <p>
                            <i class="fas fa-tachometer-alt">

                            </i>
                            <span>Dashboard</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle">
                        <i class="fas fa-users"></i>
                        <p>
                            <span>User Management</span>
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.brands.index") }}" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            <span>Brands</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.categories.index") }}" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            <span>Categories</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.products.index") }}" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            <span>Products</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>