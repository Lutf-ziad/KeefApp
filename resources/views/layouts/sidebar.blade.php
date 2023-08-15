<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url(auth()->user()->type)}}/dashboard" class="brand-link">
        <img src="{{getStorage('settings','splash_image.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Keef App</span>
    </a>
    <div class="sidebar">
        <div class="form-inline my-2 ">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @yield('sidebar')
            </ul>
        </nav>
    </div>
</aside>
