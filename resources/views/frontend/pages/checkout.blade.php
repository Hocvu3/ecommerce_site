@extends('frontend.layouts.master')
@section('content')
    <!--=============================
                        BREADCRUMB START
                    ==============================-->
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                        BREADCRUMB END
                    ==============================-->


    <!--============================
                        CHECK OUT PAGE START
                    ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__checkout_form">
                        <div class="fp__check_form">
                            <h5>select address <a href="#" data-bs-toggle="modal" data-bs-target="#address_modal"><i
                                        class="far fa-plus"></i> add address</a></h5>

                            <div class="fp__address_modal">
                                <div class="modal fade" id="address_modal" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="address_modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="address_modalLabel">add new address
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fp_dashboard_new_address d-block">
                                                    <form action="{{ route('address.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        {{-- //@method('PUT') --}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4>add new address</h4>
                                                            </div>
                                                            <div class="col-md-6 col-lg-12 col-xl-12">
                                                                <div class="fp__check_single_form">
                                                                    <select id="select_js3" name="area">
                                                                        @foreach ($deliveryAreas as $deliveryArea)
                                                                            <option value="{{ $deliveryArea->id }}">
                                                                                {{ $deliveryArea->area_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" placeholder="First Name *"
                                                                        name="first_name">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" placeholder="Last Name"
                                                                        name="last_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" placeholder="Phone *"
                                                                        name="phone">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-12 col-xl-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="email" placeholder="Email *"
                                                                        name="email">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="fp__check_single_form">
                                                                    <textarea cols="3" rows="4" placeholder="Address" name="address"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="fp__check_single_form check_area">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="type" value="home"
                                                                            id="flexRadioDefault1">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault1">
                                                                            home
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="type" value="office"
                                                                            id="flexRadioDefault2">
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            office
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                                    <button type="button"
                                                                        class="common_btn cancel_new_address">cancel</button>
                                                                </div>
                                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                                    <button type="submit" class="common_btn">save
                                                                        address</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($userAddresses as $userAddress)
                                    <div class="col-md-6">
                                        <div class="fp__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input v_address" value="{{ $userAddress->id }}"
                                                    type="radio" name="flexRadioDefault" id="home">
                                                <label class="form-check-label" for="home">
                                                    <span class="icon">
                                                        @if ($userAddress->type === 'home')
                                                            <i class="fas fa-home"></i>
                                                        @else
                                                            <i class="fas fa-car-building"></i>
                                                        @endif
                                                        {{ $userAddress->type }}
                                                    </span>
                                                    <span class="address">{{ $userAddress->address }},
                                                        {{ $userAddress->delivery_area?->area_name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div id="sticky_sidebar" class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>${{ cartTotal() }}</span></p>
                        <p>delivery: <span id="v_discount">$00.00</span></p>
                        <p>discount: <span id="discount">
                                @if (isset(session()->get('coupon')['discount']))
                                    ${{ session()->get('coupon')['discount'] }}
                                @else
                                    $0
                                @endif
                            </span>
                        </p>
                        <p class="total"><span>total:</span> <span id="v_total">${{ grandCartTotal() }}</span></p>
                        <a class="common_btn payment" id="proceed_payment" href="#">Proceed To Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                        CHECK OUT PAGE END
                    ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.v_address').prop('checked', false);
            $('.v_address').on('click', function() {
                let addressId = $(this).val();
                let discount = $('#v_discount');
                let total = $('#v_total');
                $.ajax({
                    method: 'GET',
                    url: '{{ route("checkout.calculation", ":id") }}'.replace(':id', addressId),
                    beforeSend: function() {
                        $('.overlay-container').removeClass('d-none');
                        $('.overlay').addClass('active');
                    },
                    success: function(response) {
                        discount.text('$' + response.delivery_fee);
                        total.text('$' + response.final_amount);
                        if (response.status === 'success') {
                            updateSidebarCart(function() {
                                toastr.success(response.message);
                                $('.overlay-container').addClass('d-none');
                                $('.overlay').removeClass('active');
                            });
                        }
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
            })
            $('.payment').on('click', function(e) {
                e.preventDefault();
                let addressCheck = $('.v_address:checked');
                let id = addressCheck.val();
                if (addressCheck.length === 0) {
                    toastr.error('Please choose an address');
                    return;
                };
                $.ajax({
                    method: 'POST',
                    url: '{{ route("checkout.redirect") }}',
                    data: {
                        id : id,
                        "_token": "{{ csrf_token() }}",

                    },
                    beforeSend: function() {
                        $('.overlay-container').removeClass('d-none');
                        $('.overlay').addClass('active');
                    },
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr, status, error) {

                    },
                    complete: function() {
                        $('.overlay-container').addClass('d-none');
                        $('.overlay').removeClass('active');
                    }
                })
            });
        });
    </script>
@endpush
