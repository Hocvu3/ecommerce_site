<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <h3>{{ config('app.name') }}</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.menu.show') }}"><i class="fas fa-hamburger"></i> menu</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('chefs.index') }}">chefs</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.index') }}"><i class="fas fa-newspaper"></i> blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about.index') }}"><i class="fas fa-address-card"></i> about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}"><i class="fas fa-phone-square-alt"></i> contact</a>
                </li>
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form action="{{ route('product.menu.show') }}" method="GET">
                            @csrf
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . ." name="search">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i> <span  class="cart_count">{{ count(Cart::content()) }}</span></a>
                </li>
                <li>
                    <a><i class="fas fa-comment-dots"></i></a>
                </li>
                <li>
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (<span class="cart_count">{{ count(Cart::content()) }}</span>)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cart_content">
            @foreach (Cart::content() as $cartProduct)
                <li>
                    <div class="menu_cart_img">
                        <img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="menu"
                            class="img-fluid w-100">
                    </div>
                    <div class="menu_cart_text">
                        <a class="title"
                            href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!}
                        </a>
                        <p class="size">Qty: {{ $cartProduct->qty }}</p>
                        <p class="size">{{ @$cartProduct->options->product_size['name']}}
                            {{@$cartProduct->options->product_size['price'] ? ': $'.$cartProduct->options->product_size['price'] : '' }}</p>
                        @foreach ($cartProduct->options->product_option as $cartProductOption)
                            <span class="extra">{{ $cartProductOption['name'] }}:
                                ${{ $cartProductOption['price'] }}</span>
                        @endforeach
                        <h5 class="price">${{ $cartProduct->price }}</h5>
                    </div>
                    <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i class="fal fa-times"></i></span>
                </li>
            @endforeach
            {{-- <li>
                <div class="menu_cart_img">
                    <img src="images/menu8.png" alt="menu" class="img-fluid w-100">
                </div>
                <div class="menu_cart_text">
                    <a class="title" href="#">Hyderabadi Biryani </a>
                    <p class="size">small</p>
                    <span class="extra">coca-cola</span>
                    <span class="extra">7up</span>
                    <p class="price">$99.00 <del>$110.00</del></p>
                </div>
                <span class="del_icon"><i class="fal fa-times"></i></span>
            </li> --}}
        </ul>
        <p class="subtotal">sub total <span class="cart_sub_total">${{ cartTotal() }}</span></p>
        <a class="cart_view" href="{{ route('cart-view') }}"> view cart</a>
        <a class="checkout" href="{{ route('checkout') }}">checkout</a>
    </div>
</div>

<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form">
                        <input class="reservation_input" type="text" placeholder="Name">
                        <input class="reservation_input" type="text" placeholder="Phone">
                        <input class="reservation_input" type="date">
                        <select class="reservation_input" id="select_js">
                            <option value="">select time</option>
                            <option value="">08.00 am to 09.00 am</option>
                            <option value="">10.00 am to 11.00 am</option>
                            <option value="">12.00 pm to 01.00 pm</option>
                            <option value="">02.00 pm to 03.00 pm</option>
                            <option value="">04.00 pm to 05.00 pm</option>
                        </select>
                        <select class="reservation_input" id="select_js2">
                            <option value="">select person</option>
                            <option value="">1 person</option>
                            <option value="">2 person</option>
                            <option value="">3 person</option>
                            <option value="">4 person</option>
                            <option value="">5 person</option>
                        </select>
                        <button type="submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
