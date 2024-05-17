@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Slider</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Create</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Offer</label>
                        <input type="text" name="offer" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Sub_title</label>
                        <input type="text" name="sub_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Short_description</label>
                        <textarea name="short_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Button_link</label>
                        <input type="text" name="button_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                      </div>
                      <button class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
