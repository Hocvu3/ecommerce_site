@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mail Settings</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Mail Settings</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="paypal-setting" role="tabpanel"
                                aria-labelledby="home-tab4">
                                <div class="card">
                                    <div class="card-body border">
                                        <form action="{{ route('admin.email-settings.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label>Mailer</label>
                                                <input type="text" name="mailer" value="{{ config('settingsService.mailer') }}" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Mail Driver</label>
                                                    <input type="text" name="mail_driver" value="{{ config('settingsService.mail_driver') }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Mail Host</label>
                                                    <input type="text" name="mail_host" value="{{ config('settingsService.mail_host') }}"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Mail Port</label>
                                                <input type="text" name="mail_port" value="{{ config('settingsService.mail_port') }}" class="form-control">
                                            </div>
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label for="">Mail Username</label>
                                                    <input type="text" name="mail_username" value="{{ config('settingsService.mail_username') }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Mail Password</label>
                                                    <input type="text" name="mail_password" value="{{ config('settingsService.mail_password') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Mail Encription</label>
                                                <input type="text" name="mail_encryption" value="{{ config('settingsService.mail_encryption') }}" class="form-control">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Mail From Address</label>
                                                    <input type="text" name="mail_from_address" value="{{ config('settingsService.mail_from_address') }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Mail Receive Address</label>
                                                    <input type="text" name="mail_receive_address" value="{{ config('settingsService.mail_receive_address') }}" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
