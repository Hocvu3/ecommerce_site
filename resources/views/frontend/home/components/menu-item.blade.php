<section class="fp__menu mt_95 xs_mt_65">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_45">
                    <h4>food Menu</h4>
                    <h2>Our Popular Delicious Foods</h2>
                    <span>
                        <img src="images/heading_shapes.png" alt="shapes" class="img-fluid w-100">
                    </span>
                    <p>Objectively pontificate quality models before intuitive information. Dramatically
                        recaptiualize multifunctional materials.</p>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-12">
                <div class="menu_filter d-flex flex-wrap justify-content-center">
                    <button class=" active" data-filter="*">all menu</button>
                    @foreach ($categories as $category)
                        <button data-filter=".{{ $category->slub }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row grid">
            @foreach ($categories as $category)
                @php
                    $products = \App\Models\Product::where([
                        'show_at_home' => 1,
                        'status' => 1,
                        'category_id' => $category->id,
                    ])
                        ->orderBy('id', 'DESC')
                        ->withAvg('productRatings', 'rating')
                        ->withCount('productRatings')
                        ->take(8)
                        ->get();
                        //dd($products);
                @endphp
                @foreach ($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4  {{ $category->slub }} wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset($product->thumbnail_image) }}" alt="menu"
                                    class="img-fluid w-100">
                                <a class="category" href="#">{{ @$product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                @if ($product->product_ratings_count)
                                <p class="rating">
                                    @for ($i = 0; $i < $product->product_ratings_avg_rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    <span>{{$product->product_ratings_count}}</span>
                                </p>
                                @endif
                                <a class="title" href="{{ route('product.show',$product->slug) }}">{{ $product->name }}</a>
                                @if ($product->offer_price > 0)
                                    <h5 class="price">${{ $product->offer_price }}
                                        <del>{{ $product->price }}</del>
                                    </h5>
                                @else
                                    <h5 class="price">${{ $product->price }}</h5>
                                @endif
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"><i class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="javascript:;" onclick="loadWishList('{{ $product->id }}')"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="{{ route('product.show',$product->slug) }}"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
