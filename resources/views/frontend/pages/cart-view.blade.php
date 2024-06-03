@extends('frontend.layouts.master')
@section('content')
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                            BREADCRUMB END
                                        ==============================-->


    <!--============================
                                            CART VIEW START
                                        ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="fp__pro_img">
                                            Image
                                        </th>

                                        <th class="fp__pro_name">
                                            details
                                        </th>

                                        <th class="fp__pro_status">
                                            Base price
                                        </th>

                                        <th class="fp__pro_select">
                                            quantity
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="{{ route('cart.quantity-destroy') }}">clear all</a>
                                        </th>
                                    </tr>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td class="fp__pro_img"><img
                                                    src="{{ asset($item->options->product_info['image']) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>
                                            <td class="fp__pro_name">
                                                <a
                                                    href="{{ route('product.show', $item->options->product_info['slug']) }}">{{ $item->name }}</a>
                                                <span>{{ @$item->options->product_size['name'] }}{{ @$item->options->product_size['price'] ? ': $' . $item->options->product_size['price'] : '' }}</span>
                                                {{-- @if (@$item->options->product_option['price'] > 0) --}}
                                                @foreach (@$item->options->product_option as $product_option_value)
                                                    <p>{{ $product_option_value['name'] }}{{ $product_option_value['price'] ? ': $' . $product_option_value['price'] : '' }}
                                                    </p>
                                                @endforeach
                                                {{-- @endif --}}
                                            </td>
                                            <td class="fp__pro_status">
                                                <h6>${{ $item->price }}</h6>
                                            </td>

                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input type="text" data-id="{{ $item->rowId }}" placeholder="1"
                                                        class="quantity" value="{{ $item->qty }}" readonly>
                                                    <button class="btn btn-success increment"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6 class="cart-product-total">${{ cartProductTotal($item->rowId) }}</h6>
                                            </td>

                                            <td class="fp__pro_icon">
                                                <a href="#" class="remove-product" data-id="{{ $item->rowId }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="subtotal">${{ cartTotal() }}</span></p>
                        <p>delivery: <span id="delivery">$00.00</span></p>
                        <p>discount: <span id="discount">
                                @if (isset(session()->get('coupon')['discount']))
                                    ${{ session()->get('coupon')['discount'] }}
                                @else
                                    $0
                                @endif
                            </span>
                        </p>

                        <p class="total"><span>total:</span> <span id="total">
                                @if (isset(session()->get('coupon')['discount']))
                                    ${{ cartTotal() - session()->get('coupon')['discount'] }}
                                @else
                                    ${{ cartTotal() }}
                                @endif
                            </span></p>
                        <form id="coupon_form">
                            <input type="text" id="coupon_code" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>
                        <div class="coupon_card">
                            @if (session()->has('coupon'))
                            <div class="card mt-2">
                                <div class="m-3">
                                    <span>
                                        <b class="v_coupon_code">{{ session()->get('coupon')['code'] }}</b>
                                    </span>
                                    <span>
                                        <button id="remove_coupon"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <a class="common_btn" href="{{ route('checkout') }}">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                          CART VIEW END
                ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var cartTotal = parseInt("{{ cartTotal() }}");
            $('.increment').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                inputField.val(currentValue + 1);
                updateQty(rowId, inputField.val(), function(response) {
                    let product_total = response.product_total;
                    cartTotal = response.total;
                    $('#subtotal').text('$' + cartTotal);
                    $('#total').text('$' + response.grand_cart_total);
                    inputField.closest("tr").find(".cart-product-total").text('$' + product_total);
                    if (response.status === 'error') {
                        inputField.val(response.qty);
                        toastr.error(response.message);
                    };
                    // if(response.status==='success'){
                    //     inputField.val(response.qty);
                    //     let product_total = response.product_total;
                    //     inputField.closest("tr").find(".cart-product-total").text('$'+product_total);
                    // }else if(response.status ==='error'){
                    //     inputField.val(response.qty);
                    //     toastr.error(response.message);
                    // }
                });
            });
            $('.decrement').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                if (currentValue > 1) {
                    inputField.val(currentValue - 1);
                    updateQty(rowId, inputField.val(), function(response) {
                        let product_total = response.product_total;
                        cartTotal = response.total;
                        $('#subtotal').text('$' + cartTotal);
                        $('#total').text('$' + response.grand_cart_total);
                        inputField.closest("tr").find(".cart-product-total").text('$' +
                            product_total);
                        if (response.status === 'error') {
                            inputField.val(response.qty);
                            toastr.error(response.message);
                        };
                        // if(response.status==='success'){
                        //     inputField.val(response.qty);
                        //     let product_total = response.product_total;
                        //     inputField.closest("tr").find(".cart-product-total").text('$'+product_total);
                        // }else if(response.status==='error'){
                        //     inputField.val(response.qty);
                        //     toastr.error(response.message);
                        // }
                    });
                }
            });
            $('.remove-product').on('click', function(e) {
                e.preventDefault();
                let rowId = $(this).data('id');
                removeProduct(rowId);
                $(this).closest("tr").remove();
            });

            function removeProduct(rowId) {
                $.ajax({
                    method: 'get',
                    url: '{{ route("remove-cart-product", ":rowId") }}'.replace(":rowId", rowId),
                    beforeSend: function() {
                        activeLoader();
                    },
                    success: function(response) {
                        toastr.success('removed successfully');
                        updateSidebarCart();
                        cartTotal = response.total;
                        $('#subtotal').text('$' + cartTotal);
                        $('#total').text('$' + response.grand_cart_total);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        deactiveLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        $('.overlay-container').addClass('d-none');
                        $('.overlay').removeClass('active');
                    }
                })
            };

            function updateQty(rowId, qty, callback) {
                $.ajax({
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        qty: qty,
                        _token: '{{ csrf_token() }}',
                        // Ensure 'id' is defined somewhere in the scope if used intentionally
                        // id: id,
                    },
                    url: '{{ route('cart.quantity-update') }}',
                    beforeSend: function() {
                        activeLoader();
                        // You can add logic here that needs to run before the request is sent
                    },
                    success: function(response) {
                        // Handle the successful response here
                        if (callback && typeof callback === 'function') {
                            callback(response);
                        }
                        updateSidebarCart();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here
                        let errorMessage = xhr.responseJSON.message;
                        deactiveLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        deactiveLoader();
                        // This function runs after the request completes, regardless of success or error
                    }
                });
            };
            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let subtotal = cartTotal;
                let code = $('#coupon_code').val();
                couponApply(code, subtotal);
            });

            function couponApply(code, subtotal) {
                $.ajax({
                    method: 'post',
                    url: '{{ route("coupon.apply") }}',
                    data: {
                        code: code,
                        subtotal: subtotal,
                        _token: '{{ csrf_token() }}',
                    },
                    beforeSend: function() {
                        activeLoader();
                    },
                    success: function(response) {
                        $('#discount').text('$' + response.discount);
                        $('#total').text('$' + response.finalTotal);
                        $('#coupon_code').val("");
                        toastr.success(response.message);
                        $couponCartHtml = `<div class="card mt-2">
                                <div class="m-3">
                                    <span>
                                        <b class="v_coupon_code">${response.coupon_code}</b>
                                    </span>
                                    <span>
                                        <button id="remove_coupon"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            </div>`
                        $('.coupon_card').html($couponCartHtml);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        deactiveLoader();
                    }
                });
            };
            $(document).on('click','#remove_coupon',function(e){
                e.preventDefault();
                destroyCoupon();
            })
            function destroyCoupon(){
                $.ajax({
                    method:'POST',
                    url: '{{ route("coupon.destroy") }}',
                    data: {
                        _token: '{{ csrf_token() }}',

                    },
                    beforeSend: function() {
                        activeLoader();
                    },
                    success: function(response) {
                        $('.coupon_card').html("");
                        $('#total').text(response.grand_cart_total);
                        $('#discount').text('$0');
                        toastr.success('removed successfully');
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        deactiveLoader();
                    }
                });
            }
        })
    </script>
@endpush
