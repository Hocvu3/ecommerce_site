@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Profile</h1>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Update User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="avatar" id="image-upload">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{ auth()->user()->email }}" class="form-control">
                        </div>
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Update Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.change-password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="current_password">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css(
                {
                    'background-image' : 'url({{ asset(auth()->user()->avatar) }})',
                    'background-size' : 'cover',
                    'background-position' : 'center'
                }
            )
        })
    </script>
@endpush
