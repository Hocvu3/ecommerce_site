@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.update', $categories->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $categories->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option {{ $categories->show_at_home === 1 ? 'selected' : '' }} value="1">Yes</option>
                            <option {{ $categories->show_at_home === 0 ? 'selected' : '' }} value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $categories->status === 1 ? 'selected' : '' }} value="1">1</option>
                            <option {{ $categories->status === 0 ? 'selected' : '' }} value="0">0</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
