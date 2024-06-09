@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Contact Settings</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Contact Settings</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="paypal-setting" role="tabpanel"
                                aria-labelledby="home-tab4">
                                <div class="card">
                                    <div class="card-body border">
                                        <form action="{{ route('admin.contact.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label>Phone One</label>
                                                <input type="number" name="phone_one" value="{{ @$contact->phone_one }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone Two</label>
                                                <input type="number" name="phone_two" value="{{ @$contact->phone_two }}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email One</label>
                                                <input type="text" name="email_one" value="{{ @$contact->mail_one }}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email Two</label>
                                                <input type="text" name="email_two" value="{{ @$contact->mail_two }}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" value="{{ @$contact->address }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Map Link</label>
                                                <input type="text" name="map_link" value="{{ @$contact->map_link }}" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @push('scripts')
                                {{-- <script>
                                    $(document).ready(function() {
                                        $('.image-preview').css({
                                            'background-image': 'url({{ asset(@$abouts->image) }})',
                                            'background-size': 'cover',
                                            'background-position': 'center center'
                                        })
                                    })
                                </script> --}}
                            @endpush
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
