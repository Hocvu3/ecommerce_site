<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
<form action="" id="modal_add_to_cart">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="fp__cart_popup_img">
        <img src="{{ asset($product->thumbnail_image) }}" alt="menu" class="img-fluid w-100">
    </div>
    <div class="fp__cart_popup_text">
        <a href="#" class="title">{{ $product->name }}</a>
        <p class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span>(201)</span>
        </p>
        @if ($product->offer_price > 0)
            <input type="hidden" name="base_price" value="{{ $product->offer_price }}">

            <h5 class="price">${{ $product->offer_price }}
                <input type="hidden" name="base_price" value="{{ $product->price }}">

                <del>{{ $product->price }}</del>
            </h5>
        @else
            ${{ $product->offer_price }}
        @endif
        @if ($product->productSizes()->exists())
            <div class="details_size">
                <h5>select size</h5>
                @foreach ($product->productSizes as $productSize)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="{{ $productSize->id }}"
                            data-price="{{ $productSize->price }}" name="product_size"
                            id="size-{{ $productSize->id }}">
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
                        <input class="form-check-input" type="checkbox" value="{{ $productOption->id }}"
                            name="product_option[]" data-price="{{ $productOption->price }}"
                            id="option-{{ $productOption }}">
                        <label class="form-check-label" for="option-{{ $productOption }}">
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
                    <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                    <input type="text" id="quantity" name="quantity" placeholder="1" value="1" readonly>
                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                </div>
                <div class="quentity_btn">
                    @if ($product->offer_price > 0)
                        <h3 id="total-price" class="price">${{ $product->offer_price }}
                        </h3>
                    @else
                        <h3 id="total-price">${{ $product->offer_price }}</h3>
                    @endif
                </div>
            </div>
        </div>
        <ul class="details_button_area d-flex flex-wrap">
            {{-- <li><a class="common_btn" href="#">add to cart</a></li> --}}
            @if ($product->quantity > 0)
            <button type="submit" class="common_btn modal-cart-button">add to cart</button>
            @else
            <li><a class="common_btn bg-secondary" href="javascript:;">out of stock</a></li>
            @endif
        </ul>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('input[name="product_size"]').on('change', function() {
            updateTotalPrice();
        });
        $('input[name="product_option[]"]').on('change', function() {
            updateTotalPrice();
        });
        $('.increment').on('click', function(e) {
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            quantity.val(currentQuantity + 1);
            updateTotalPrice();

        });
        $('.decrement').on('click', function(e) {
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            if (currentQuantity > 1) {
                quantity.val(currentQuantity - 1);
                updateTotalPrice();
            }
        });
        //function to update total price
        function updateTotalPrice() {
            let basePrice = parseFloat($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionPrice = 0;
            let quantity = parseFloat($('#quantity').val());

            //calculate
            let selectedSize = $('input[name="product_size"]:checked');
            if (selectedSize.length > 0) {
                selectedSizePrice = parseFloat(selectedSize.data('price'));
            }
            let selectedOption = $('input[name="product_option[]"]:checked');
            $(selectedOption).each(function() {
                selectedOptionPrice += parseFloat($(this).data("price"));
            })
            //alert(selectedOptionPrice);

            let totalPrice = (basePrice + selectedOptionPrice + selectedSizePrice) * quantity;
            $('#total-price').text('$' + totalPrice);
        }
        //handle add to cart
        $('#modal_add_to_cart').on('submit', function(e) {
            e.preventDefault();
            //validation
            let selectedSize = $("input[name='product_size']");
            if (selectedSize.length > 0) {
                if ($("input[name='product_size']:checked").val() === undefined) {
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
                    $('.modal-cart-button').attr('disabled',true);
                    $('.modal-cart-button').html(
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
                complete: function(){
                    $('.modal-cart-button').html('Add To Cart');
                    $('.modal-cart-button').attr('disabled',false);

                }
            })
        });
    })
</script>
