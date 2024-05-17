<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    {{-- <meta name="csrf_token" content="{{ csrf_token() }}" /> --}}
    {{-- mat rat nhieu thoi gian cai cho nay :>> khac nhau khong nhieu --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('admin.layouts.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Template JS File -->
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <script>
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.closeDuration = 300;

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function() {

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });


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
                                //  _method: 'DELETE', // Method spoofing to DELETE
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // CSRF token
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
        });
    </script>
    @stack('scripts')
</body>

</html>
