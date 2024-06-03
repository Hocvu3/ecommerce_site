<script>
    function loadProductModal(productId) {
        //alert(productId)
        $.ajax({
            method: 'GET',
            url: '{{ route('load-product-modal', ':productId') }}'.replace(":productId", productId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },
            success: function(response) {
                $('.load-product-modal-body').html(response);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {

            },
            complete: function() {
                $('.overlay-container').addClass('d-none');
                $('.overlay').removeClass('active');
            }
        })
    }

    function updateSidebarCart(callback = null) {
        $.ajax({
            method: 'GET',
            url: '{{ route('get-cart') }}',
            success: function(response) {
                $('.cart_content').html(response);
                let cartTotal = $('#cart_total').val();
                $('.cart_sub_total').text('$' + cartTotal);
                //count
                let cartCount = $('#cart_product_count').val();
                $('.cart_count').text(cartCount);
                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {

            }
        })
    }

    function activeLoader() {
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    function deactiveLoader() {
        $('.overlay-container').addClass('d-none');
        $('.overlay').removeClass('active');
    }
    //remove cart product
    function removeProductFromSidebar($rowId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('remove-cart-product', ':rowId') }}'.replace(":rowId", $rowId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },
            success: function(response) {
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
    }

    function getCartTotal() {
        return parseInt("{{ cartTotal() }}");
    }
    $('body').on('click', '.delete-item', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        console.log(url);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE', // Use POST for method spoofing
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            window.location.reload();
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        toastr.error(response.message ||
                            'An error occurred while processing the request.'
                        );
                    }
                });
            }
        });
    });
</script>
