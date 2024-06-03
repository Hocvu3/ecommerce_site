@extends('admin.layouts.master')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>Product Gallery</h1>
        </div>
        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary mb-3">Go Back</a>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Product Gallery ({{ $product->name }})</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-5">
                    <form action="{{ route('admin.product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input type="file" class="form-control" name="image">
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_gallery as $product_gallery)
                            <tr>
                                <th><img width="100px" src="{{ asset($product_gallery->image) }}"></th>
                                <th><a href="{{ route('admin.product-gallery.destroy', $product_gallery->id) }}"
                                        class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
