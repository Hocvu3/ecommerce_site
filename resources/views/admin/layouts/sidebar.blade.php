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
                {{-- "{{ route('admin.profile') }}" --}}
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault();
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
            <a href="{{ route('admin.dashboard') }}">DashBoard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="far fa-square"></i>
                    <span>Dashboard</span></a></li>
            <li class="menu-header">Starter</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>User</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.user.index') }}">
                            <span>User</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Product</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.category.index') }}"><span>Category</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.product.index') }}"><span>Product</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.coupon.index') }}"><span>Coupon</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.product.rating') }}"><span>Ratings</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Blogs</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.blog-category.index') }}"><span>Blog
                                Category</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.blog.index') }}"><span>Blog</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.blog-comment.index') }}"><span>Blog
                                Comment</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Delivery</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.delivery-area.index') }}"><span>Delivery
                                Area</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Order</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.order.index') }}"><span>Order</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>About</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.about.index') }}"><span>About</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Contact</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.contact.index') }}"><span>Contact</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Configurations</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.email-settings.index') }}">Email</a></li>
                    <li><a class="nav-link"
                            href="{{ route('admin.payment-settings.index') }}"><span>PaymentGateWay</span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.slider.index') }}">
                            <span>Slider</span></a></li>
                    <li><a class="nav-link" href="{{ route('admin.contact.index') }}">
                            <span>Footer</span></a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
