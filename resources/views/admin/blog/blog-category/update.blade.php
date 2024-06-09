@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Blog Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-category.update',$blog_categories->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $blog_categories->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected($blog_categories->status === '1') value="1">1</option>
                            <option @selected($blog_categories->status === '0') value="0">0</option>
                        </select>
                      </div>
                      <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
