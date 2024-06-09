@extends('admin.layouts.master')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>Product Rating</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Product Rating</h4>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('body').on('change', '.review_status', function() {
                //alert('hi');
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.product-rating.update') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {

                    },
                })
            })
        })
    </script>
@endpush
