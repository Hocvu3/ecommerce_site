@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Product</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update',$products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image_Thumbnail</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $products->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control" id="">
                            @foreach ($categories as $category)
                                <option @selected($products->category_id ===$category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" value="{{ $products->price }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" name="offer_price" value="{{ $products->offer_price }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" name="quantity" value="{{ $products->quantity }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                            <textarea name="short_description" class="form-control summernote">{{ $products->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Long Description</label>
                            <textarea name="long_description" class="form-control summernote">{{ $products->long_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Sku</label>
                        <input type="text" name="sku" value="{{ $products->sku }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" name="seo_title" value="{{ $products->seo_title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Seo Description</label>
                            <textarea name="seo_description" class="form-control">{{ $products->seo_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option {{ $products->show_at_home == '1' ? 'selected' : '' }} value="1">1</option>
                            <option {{ $products->show_at_home == '0' ? 'selected' : '' }} value="0">0</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $products->status == '1'? 'selected' : '' }} value="1">1</option>
                            <option {{ $products->status == '0' ? 'selected' : '' }} value="0">0</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css(
                {
                    'background-image' : 'url({{ asset($products->thumbnail_image) }})',
                    'background-size' : 'cover',
                    'background-position' : 'center'
                }
            )
        })
    </script>
@endpush
