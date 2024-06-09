@extends('frontend.layouts.master')
@section('content')
    <!--=============================
                                                            BREADCRUMB START
                                                        ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>menu Details</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">menu Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                            BREADCRUMB END
                                                        ==============================-->


    <!--=============================
                                                            MENU DETAILS START
                                                        ==============================-->
    <section class="fp__menu_details mt_115 xs_mt_85 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box fp__menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumbnail_image) }}"
                                        alt="product"></li>
                                @foreach ($product->productImages as $productImage)
                                    <li><img class="zoom ing-fluid w-100" src="{{ asset($productImage->image) }}"
                                            alt="product"></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i>
                            </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_details_text">
                        <h2>{!! $product->name !!}</h2>
                        @if ($product->product_ratings_count)
                                <p class="rating">
                                    @for ($i = 0; $i < $product->product_ratings_avg_rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    <span>{{$product->product_ratings_count}}</span>
                                </p>
                                @endif
                        @if ($product->offer_price > 0)
                            <h5 class="price">${{ $product->offer_price }}
                                <del>{{ $product->price }}</del>
                            </h5>
                        @else
                            ${{ $product->price }}
                        @endif
                        <p class="short_description">{!! $product->short_description !!}</p>
                        <form action="" id="v_add_to_cart">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="base_price" class="v_base_price"
                                value="{{ $product->offer_price > 0 ? $product->offer_price : $product->price }}">
                            @if ($product->productSizes()->exists())
                                <div class="details_size">
                                    <h5>select size</h5>
                                    @foreach ($product->productSizes as $productSize)
                                        <div class="form-check">
                                            <input class="form-check-input v_product_size" type="radio"
                                                name="product_size" id="size-{{ $productSize->id }}"
                                                data-price ="{{ $productSize->price }}" value="{{ $productSize->id }}">
                                            <label class="form-check-label" for="size-{{ $productSize->id }}">
                                                {{ $productSize->name }} <span>+ ${{ $productSize->price }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($product->productOptions()->exists())
                                <div class="details_extra_item">
                                    <h5>select option <span>(optional)</span></h5>
                                    @foreach ($product->productOptions as $productOption)
                                        <div class="form-check">
                                            <input class="form-check-input v_product_option" name="product_option[]"
                                                type="checkbox" id="option-{{ $productOption->id }}"
                                                data-price="{{ $productOption->price }}" value="{{ $productOption->id }}">
                                            <label class="form-check-label" for="option-{{ $productOption->id }}">
                                                {{ $productOption->name }} <span>+ ${{ $productOption->price }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="details_quentity">
                                <h5>select quantity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger v_decrement"><i class="fal fa-minus"></i></button>
                                        <input type="text" name="quantity" placeholder="1" id="v_quantity" value="1"
                                            readonly>
                                        <button class="btn btn-success v_increment"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3 id="total_price">
                                        @if ($product->offer_price > 0)
                                            ${{ $product->offer_price }}
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </form>
                        <ul class="details_button_area d-flex flex-wrap">
                            @if ($product->quantity > 0)
                            <li><a class="common_btn v_submit_button" href="#">add to cart</a></li>
                            @else
                            <li><a class="common_btn bg-secondary" href="javascript:;">out of stock</a></li>
                            @endif
                            <li><a class="wishlist" onclick="loadWishList('{{ $product->id }}')"><i class="far fa-heart"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="menu_det_description">
                                    {!! $product->long_description !!}
                                    ullam in? Beatae, dolorum ad ea deleniti ratione voluptatum similique omnis
                                    voluptas tempora optio soluta vero veritatis reiciendis blanditiis architecto.
                                    Debitis nesciunt inventore voluptate tempora ea incidunt iste, corporis, quo
                                    cumque facere doloribus possimus nostrum sed magni quasi, assumenda autem!
                                    Repudiandae nihil magnam provident illo alias vero odit repellendus, ipsa nemo
                                    itaque. Aperiam fuga, magnam quia illum minima blanditiis tempore.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="fp__review_area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>{{ count($ratings) }} reviews</h4>
                                            @foreach ($ratings as $rating)
                                            <div class="fp__comment pt-0 mt_20">
                                                <div class="fp__single_comment m-0 border-0">
                                                    <img src="{{ asset($rating->users->avatar) }}" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>{{ $rating->users->name }} <span>{{ $rating->created_at }}</span></h3>
                                                        <span class="rating">
                                                            @for ($i = 1; $i <= $rating->rating; $i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            <b>({{ count($ratings) }})</b>
                                                        </span>
                                                        <p>{!! $rating->comment !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @if(count($ratings) == 0)
                                                <p class="text-center">No reviews yet</p>
                                            @endif
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fp__post_review">
                                                <h4>write a Review</h4>
                                                <form action="{{ route('product.review.store') }}" method="POST">
                                                    @csrf
                                                    <p class="rating">
                                                        <span>select your rating : </span>
                                                        <i class="fas fa-star"></i>
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <select name="rating" id="rating_input">Choose
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <textarea rows="3" name="review" placeholder="Write your review"></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fp__related_menu mt_90 xs_mt_60">
                <h2>related item</h2>
                <div class="row related_product_slider">
                    @foreach ($relatedProduct as $relatedProduct)
                        <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                            <div class="fp__menu_item">
                                <div class="fp__menu_item_img">
                                    <img src="{{ asset($relatedProduct->thumbnail_image) }}" alt="menu"
                                        class="img-fluid w-100">
                                    <a class="category" href="#">{{ $relatedProduct->category->name }}</a>
                                </div>
                                <div class="fp__menu_item_text">
                                    @if ($relatedProduct->product_ratings_count)
                                <p class="rating">
                                    @for ($i = 0; $i < $relatedProduct->product_ratings_avg_rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    <span>{{$relatedProduct->product_ratings_count}}</span>
                                </p>
                                @endif
                                    <a class="title"
                                        href="{{ route('product.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                        @if ($relatedProduct->offer_price > 0)
                                        <h5 class="price">${{ $relatedProduct->offer_price }}
                                            <del>{{ $relatedProduct->price }}</del>
                                        </h5>
                                    @else
                                        <h5 class="price">${{ $relatedProduct->price }}</h5>
                                    @endif
                                    <ul class="d-flex flex-wrap justify-content-center">
                                        <li><a href="javascript:;" onclick="loadProductModal('{{ $relatedProduct->id }}')"><i class="fas fa-shopping-basket"></i></a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CART POPUT START -->

    <!-- CART POPUT END -->

    <!--=============================
                                                            MENU DETAILS END
                                        ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
                $('.v_product_size').prop('checked', false);
                $('.v_product_option').prop('checked', false);
                $('#v_quantity').val(1);
                $('.v_product_size').on('change', function() {
                    v_updateTotalPrice();
                });
                $('.v_product_option').on('change', function() {
                    v_updateTotalPrice();
                });
                $('.v_increment').on('click', function(e) {
                    e.preventDefault();
                    let quantity = $('#v_quantity');
                    let currentQuantity = parseFloat(quantity.val());
                    quantity.val(currentQuantity + 1);
                    v_updateTotalPrice();

                });
                $('.v_decrement').on('click', function(e) {
                    e.preventDefault();
                    let quantity = $('#v_quantity');
                    let currentQuantity = parseFloat(quantity.val());
                    if (currentQuantity > 1) {
                        quantity.val(currentQuantity - 1);
                        v_updateTotalPrice();
                    }
                });

                function v_updateTotalPrice() {
                    let basePrice = parseFloat($('.v_base_price').val());
                    let selectedSizePrice = 0;
                    let selectedOptionPrice = 0;
                    let quantity = parseFloat($('#v_quantity').val());
                    // let quantity = 1;

                    //calculate
                    let selectedSize = $('.v_product_size:checked');
                    if (selectedSize.length > 0) {
                        selectedSizePrice = parseFloat(selectedSize.data('price'));
                    }
                    let selectedOption = $('.v_product_option:checked');
                    $(selectedOption).each(function() {
                        selectedOptionPrice += parseFloat($(this).data("price"));
                    })
                    //alert(selectedOptionPrice);

                    let totalPrice = (basePrice + selectedOptionPrice + selectedSizePrice) * quantity;
                    $('#total_price').text('$' + totalPrice);
                }
            }),
            $('.v_submit_button').on('click', function(e) {
                e.preventDefault();
                $('#v_add_to_cart').submit();
            }),
            $('#v_add_to_cart').on('submit', function(e) {
                e.preventDefault();
                //validation
                let selectedSize = $(".v_product_size");
                if (selectedSize.length > 0) {
                    if ($(".v_product_size:checked").val() === undefined) {
                        toastr.error('Please choose a size');
                        return;
                    }
                }
                let formData = $(this).serialize();
                $.ajax({
                    method: 'GET',
                    url: '{{ route("add-to-cart") }}',
                    data: formData,
                    beforeSend: function() {
                        $('.v_submit_button').attr('disabled', true);
                        $('.v_submit_button').html(
                            '<span class="spinner-border spinner-border-sm text-light modal-cart-button" role="status" aria-hidden="true"></span> Loading...'
                        )
                    },
                    success: function() {
                        updateSidebarCart();
                        toastr.success('product added success fully');
                    },
                    error: function(xhr, status, error) {
                        let errormessage = xhr.responseJSON.message;
                        toastr.error(errormessage);
                    },
                    complete: function() {
                        $('.v_submit_button').html('Add To Cart');
                        $('.v_submit_button').attr('disabled', false);

                    }
                })
            });
    </script>
@endpush
