@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Slider</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label>Offer</label>
                        <input type="text" name="offer" value="{{ $slider->offer }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Sub_title</label>
                        <input type="text" name="sub_title" value="{{ $slider->sub_title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Short_description</label>
                        <textarea name="short_description" class="form-control">{{ $slider->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Button_link</label>
                        <input type="text" name="button_link" value="{{ $slider->button_link }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $slider->status ==1 ? 'selected' : '' }} value="1">1</option>
                            <option {{ $slider->status ==0 ? 'selected' : '' }} value="0">0</option>
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
                    'background-image' : 'url({{ asset($slider->image) }})',
                    'background-size' : 'cover',
                    'background-position' : 'center'
                }
            )
        })
    </script>
@endpush

