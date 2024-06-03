<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                {{-- "{{ route('admin.profile') }}" --}}
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                    this.closest('form').submit();"">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">DashBoard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Starter</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Product Manage</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.category.index') }}">Category</a></li>
                    <li><a class="nav-link" href="{{ route('admin.product.index') }}">Product</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="{{ route('admin.payment-settings.index') }}"><i class="far fa-square"></i> <span>PaymentGateWay</span></a></li>
            <li><a class="nav-link" href="{{ route('admin.coupon.index') }}"><i class="far fa-square"></i> <span>Coupon</span></a></li>
            <li><a class="nav-link" href="{{ route('admin.delivery-area.index') }}"><i class="far fa-square"></i> <span>Delivery Area</span></a></li>
            <li><a class="nav-link" href="{{ route('admin.slider.index') }}"><i class="far fa-square"></i> <span>Slider</span></a></li>
        </ul>
    </aside>
</div>
