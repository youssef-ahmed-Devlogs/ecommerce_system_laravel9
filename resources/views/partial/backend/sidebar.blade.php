    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('backend.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <div id="collapseTwo"
                class="collapse {{ str_starts_with(request()->path(), 'admin/users') || str_starts_with(request()->path(), 'admin/roles') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('backend.users.index') }}">Users</a>
                    <a class="collapse-item" href="{{ route('backend.users.create') }}">Add User</a>
                    <a class="collapse-item" href="{{ route('backend.roles.index') }}">Roles</a>
                </div>
            </div>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                aria-expanded="true" aria-controls="collapseCategory">
                <i class="fas fa-list"></i>
                <span>Categories</span>
            </a>
            <div id="collapseCategory"
                class="collapse {{ str_starts_with(request()->path(), 'admin/categories') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('backend.categories.index') }}">Categories</a>
                    <a class="collapse-item" href="{{ route('backend.categories.create') }}">Add Category</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
                aria-expanded="true" aria-controls="collapseProduct">
                <i class="fas fa-box-open"></i>
                <span>Products</span>
            </a>
            <div id="collapseProduct"
                class="collapse {{ str_starts_with(request()->path(), 'admin/products') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('backend.products.index') }}">Products</a>
                    <a class="collapse-item" href="{{ route('backend.products.reviews.index') }}">Products Reviews</a>
                    <a class="collapse-item" href="{{ route('backend.products.create') }}">Add Product</a>
                </div>
            </div>
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
