@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>About Settings</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>About</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="paypal-setting" role="tabpanel"
                                aria-labelledby="home-tab4">
                                <div class="card">
                                    <div class="card-body border">
                                        <form action="{{ route('admin.about.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <label>About Logo</label>
                                            <div id="image-preview" class="image-preview" name="about_logo">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="about_logo" id="image-upload">
                                                <input type="hidden" name="old_about_logo" value="{{ $abouts->image }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" value="{{ $abouts->title }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Main Title</label>
                                                <input type="text" name="main_title" value="{{ $abouts->main_title }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea type="text" name="description"
                                                    class="form-control summernote" >{{ $abouts->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Video Link</label>
                                                <input type="text" name="video_link" value="{{ $abouts->video_link }}" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @push('scripts')
                                <script>
                                    $(document).ready(function() {
                                        $('.image-preview').css({
                                            'background-image': 'url({{ asset(@$abouts->image) }})',
                                            'background-size': 'cover',
                                            'background-position': 'center center'
                                        })
                                    })
                                </script>
                            @endpush
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
