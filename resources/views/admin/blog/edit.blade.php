@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Blog</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $blog->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="blog_category_id" class="form-control" id="">
                            @foreach ($blog_categories as $category)
                                <option @selected($blog->blog_category_id ===$category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                            <textarea name="description" class="form-control summernote">{{ $blog->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" name="seo_title" value="{{ $blog->seo_title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Seo Description</label>
                            <textarea name="seo_description" class="form-control">{{ $blog->seo_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $blog->status == '1' ? 'selected' : '' }} value="1">1</option>
                            <option {{ $blog->status == '0' ? 'selected' : '' }} value="0">0</option>
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
                    'background-image' : 'url({{ asset($blog->image) }})',
                    'background-size' : 'cover',
                    'background-position' : 'center'
                }
            )
        })
    </script>
@endpush
