@extends('frontend.layouts.master')
@section('content')
    <!--=============================
            BREADCRUMB START
        ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>payment</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">payment</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
            BREADCRUMB END
        ==============================-->


    <!--============================
            PAYMENT PAGE START
        ==============================-->
    <section class="fp__payment_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="fp__payment_area">
                        <div style="font-size: 50px">Select Payment Method: </div>
                        <div class="row">
                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment payment_card" data-name="paypal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" href="#">
                                    <img src="{{ asset('frontend/images/pay_1.jpg') }}" alt="payment method"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment payment_card" data-name="momo" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    href="#">
                                    <img src="{{ asset('frontend/images/momo.png') }}" alt="payment method"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment" data-name="vnpay" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    href="#">
                                    <img src="{{ asset('frontend/images/vnpay.jpg') }}" alt="payment method"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment" data-name="cod" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    href="#">
                                    <img src="{{ asset('frontend/images/cod.jpg') }}" alt="payment method"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt_25 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>${{ $subTotal }}</span></p>
                        <p>delivery: <span>${{ $deliveryCharge }}</span></p>
                        <p>discount: <span>${{ $discount }}</span></p>
                        <p class="total"><span>total:</span> <span>${{ $grandTotal }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.payment_card').on('click', function(e) {
                e.preventDefault();
                let paymentGateway = $(this).data('name');
                $.ajax({
                    method: 'POST',
                    url: '{{ route("payment.make") }}',
                    data: {
                        payment_gateway:paymentGateway,
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
                        let errror = xhr.responseJSON.errors;
                        $.each(errror,function(index,value){
                            toastr.error(value);
                        })
                    },
                    complete: function() {
                    }
                })
            })
        })
    </script>
@endpush
