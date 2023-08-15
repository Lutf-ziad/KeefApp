<li class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ getRequest('admin/dashboard', 'active') }}">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>
            {{ __('Dashboard') }}
        </p>
    </a>
</li>
<li class="nav-item {{ getRequest('admin/clients*', 'menu-open') }}">
    <a href="#" class="nav-link {{ getRequest('admin/clients*', 'active') }}">
        <i class="nav-icon fa fa-people-arrows"></i>
        <p>
            {{ __('Clients') }}
            <i class="right fas fa-angle-right"></i> <!-- RTL left -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('clients.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Clients List') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clients.create') }}"
                class="nav-link {{ getRequest('admin/clients/create', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Add Client') }}</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('categories') }}" class="nav-link {{ getRequest('admin/categories', 'active') }}">
        <i class="fas fa-th nav-icon"></i>
        <p>{{ __('Categories List') }}</p>
    </a>
</li>
<li class="nav-item {{ getRequest('admin/shops*', 'menu-open') }}">
    <a href="#" class="nav-link {{ getRequest('admin/shops*', 'active') }}">
        <i class="nav-icon fas fa-store-alt"></i>
        <p>
            {{ __('Shops') }}
            <i class="right fas fa-angle-right"></i> <!-- RTL left -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('shops.index') }}" class="nav-link {{ getRequest('admin/shops', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Shops List') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('shops.create') }}"
                class="nav-link {{ getRequest('admin/shops/create', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Add Shop') }}</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ getRequest('admin/products*', 'menu-open') }}">
    <a href="#" class="nav-link {{ getRequest('admin/products*', 'active') }}">
        <i class="nav-icon fas fa-tags"></i>
        <p>
            {{ __('Products') }}
            <i class="right fas fa-angle-right"></i> <!-- RTL left -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link {{ getRequest('admin/products', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Products List') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.create') }}"
                class="nav-link {{ getRequest('admin/products/create', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Add Product') }}</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ getRequest('admin/promotions*', 'menu-open') }}">
    <a href="#" class="nav-link {{ getRequest('admin/promotions*', 'active') }}">
        <i class="nav-icon fas fa-percentage"></i>
        <p>
            {{ __('Promotions') }}
            <i class="right fas fa-angle-right"></i> <!-- RTL left -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('promotions.index') }}" class="nav-link {{ getRequest('admin/promotions', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Promotions List') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('promotions.create') }}"
                class="nav-link {{ getRequest('admin/promotions/create', 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Add Promotions') }}</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('packages') }}" class="nav-link {{ getRequest('admin/packages', 'active') }}">
        <i class="fas fa-th nav-icon"></i>
        <p>{{ __('Packages List') }}</p>
    </a>
</li>
