@extends('frontend.layouts.master')
@section('content')
 <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Info</h1>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        ABOUT PAGE START
    ==============================-->
    <section class="fp__about_us mt_120 xs_mt_90">
        <div class="container">
            <div class="row">
                <div class="text-center" >
                    <div class="mb-4">
                        <i class="fas fa-check-circle" style="
                            font-size: 70px;
                            background: green;
                            padding: 20px;
                            border-radius: 50%;
                            color: #fff;
                            "></i>
                    </div>
                    <h4>Order Placed Successfully</h4>
                    <a class="common_btn mt-5 mb-5" href="{{ route('dashboard') }}">Go To Dashboard</a>
                </div>
            </div>
        </div>
    </section>
@endsection
