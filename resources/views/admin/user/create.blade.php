@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create User</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Create</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>PassWord</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                    </div>
                    <button class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
