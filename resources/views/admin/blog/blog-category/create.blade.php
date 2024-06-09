@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Blog Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Create</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
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
