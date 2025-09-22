{{-- Example Navigation with Permissions --}}
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        
        <a class="navbar-brand text-success logo h1 align-self-center" href="/">
            Zac Fashion
        </a>

        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between">
            <div class="flex-fill">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    
                    {{-- Shop link - accessible to all --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                    </li>

                    {{-- Admin Menu --}}
                    @can('view-admin-dashboard')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                Admin Panel
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                
                                @can('view-users')
                                    <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Users</a></li>
                                @endcan
                                
                                @can('view-brands')
                                    <li><a class="dropdown-item" href="{{ route('admin.brands.index') }}">Manage Brands</a></li>
                                @endcan
                                
                                @can('view-categories')
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                                @endcan
                                
                                @can('view-products')
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">All Products</a></li>
                                @endcan
                                
                                @can('view-sliders')
                                    <li><a class="dropdown-item" href="{{ route('admin.sliders.index') }}">Manage Sliders</a></li>
                                @endcan
                                
                                @can('view-all-orders')
                                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">All Orders</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    {{-- Vendor Menu --}}
                    @can('view-vendor-dashboard')
                        @if(!auth()->user()->hasRole('admin')) {{-- Don't show vendor menu to admin --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="vendorDropdown" role="button" data-bs-toggle="dropdown">
                                    Vendor Panel
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
                                    
                                    @can('view-own-products')
                                        <li><a class="dropdown-item" href="{{ route('vendor.products.index') }}">My Products</a></li>
                                    @endcan
                                    
                                    @can('create-products')
                                        <li><a class="dropdown-item" href="{{ route('vendor.products.create') }}">Add Product</a></li>
                                    @endcan
                                    
                                    @can('view-own-orders')
                                        <li><a class="dropdown-item" href="{{ route('vendor.orders.index') }}">My Orders</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    @endcan
                </ul>
            </div>

            <div class="navbar align-self-center d-flex">
                @auth
                    {{-- User is logged in --}}
                    @can('add-to-cart')
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('cart') }}">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="cart-count">0</span>
                        </a>
                    @endcan
                    
                    @can('view-wishlist')
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('wishlist') }}">
                            <i class="fa fa-fw fa-heart text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="wishlist-count">0</span>
                        </a>
                    @endcan

                    {{-- User Dropdown --}}
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @can('view-profile')
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            @endcan
                            
                            @hasrole('user')
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}">My Orders</a></li>
                            @endhasrole
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- User is not logged in --}}
                    <a class="nav-icon text-decoration-none" href="{{ route('login') }}">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>