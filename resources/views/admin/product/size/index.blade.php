@extends('admin.layouts.master')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>Product Variants ({{ $product->name }})</h1>
        </div>
        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary mb-3">Go Back</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Product Size</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('admin.product-size.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Size</label>
                                        <input type="text" name="size" value="{{ old('size') }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Price</label>
                                        <input type="text" name="price" value="{{ old('price') }}"
                                            class="form-control">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>.No</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_size as $product_size)
                                    <tr>
                                        <th>{{ ++$loop->index }}</th>
                                        <th><label>{{ $product_size->name }}</label></th>
                                        <th><label>${{ $product_size->price }}</label></th>
                                        <th><a href="{{ route('admin.product-size.destroy', $product_size->id) }}"
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Product Option</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('admin.product-option.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Option</label>
                                        <input type="text" name="option" value="{{ old('option') }}" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Price</label>
                                        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>.No</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_option as $product_option)
                                    <tr>
                                        <th>{{ ++$loop->index }}</th>
                                        <th><label>{{ $product_option->name }}</label></th>
                                        <th><label>${{ $product_option->price }}</label></th>
                                        <th><a href="{{ route('admin.product-option.destroy', $product_option->id) }}"
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
