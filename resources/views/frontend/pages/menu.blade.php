@extends('frontend.layouts.master')
@section('content')
    <!--=============================
                    BREADCRUMB START
                ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Menu</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">search result</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                    BREADCRUMB END
                ==============================-->


    <!--=============================
                    SEARCH MENU START
                ==============================-->
    <section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <form class="fp__search_menu_form" action="{{ route('product.menu.show') }}" method="GET">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <input type="text" placeholder="Search..." name="search" value="{{ request('search') }}">
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <select id="select_js3" name="category" >
                            <option value="">all</option>
                            @foreach ($categories as $category)
                                <option {{ request('category') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-2 col-md-3">
                        <button type="submit" class="common_btn">search</button>
                    </div>
                </div>
            </form>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset(@$product->thumbnail_image) }}" alt="menu" class="img-fluid w-100">
                                <a class="category" href="#">{{ @$product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                @if ($product->product_ratings_count)
                                    <p class="rating">
                                        @for ($i = 0; $i < $product->product_ratings_avg_rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span>{{ $product->product_ratings_count }}</span>
                                    </p>
                                @endif
                                <a class="title"
                                    href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                @if ($product->offer_price > 0)
                                    <h5 class="price">${{ $product->offer_price }}
                                        <del>{{ $product->price }}</del>
                                    </h5>
                                @else
                                    <h5 class="price">${{ $product->price }}</h5>
                                @endif
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="#" onclick="loadProductModal('{{ $product->id }}')"
                                            data-bs-toggle="modal" data-bs-target="#cartModal"><i
                                                class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="#" onclick="loadWishList('{{ $product->id }}')"><i
                                                class="fal fa-heart"></i></a></li>
                                    <li><a href="{{ route('product.show', $product->slug) }}"><i
                                                class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($products) == 0)
                <h4 class="text-center mt-3">No Product Found</h4>
            @endif
            @if ($products->hasPages())
                <div class="fp__pagination mt_60">
                    <div class="row pagination">
                        <div class="col-12 pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
