<div class="tab-pane fade show active" id="momo-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.momo-payment-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Momo Status</label>
                    <select name="momo_status" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['momo_status']==1) value="1">Active</option>
                        <option @selected(@$paymentGateway['momo_status']==0) value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Momo Account Mode</label>
                    <select name="momo_account_mode" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['momo_account_mode'] === 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(@$paymentGateway['momo_account_mode'] === 'live') value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Parter Code</label>
                    <input type="text" value="{{ @$paymentGateway['momo_partner_code'] }}" name="momo_partner_code" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Access Key</label>
                    <input type="text" value="{{ @$paymentGateway['momo_access_key'] }}" name="momo_access_key" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Secret Key</label>
                    <input type="text" value="{{ @$paymentGateway['momo_secret_key'] }}" name="momo_secret_key" class="form-control">
                </div>
                <div class="form-group">
                    <label>Momo Logo</label>
                    <div id="image-preview" class="image-preview momo-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="momo_logo" id="image-upload" />
                      </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.momo-preview').css({
                'background-image': 'url({{ @$paymentGateway["momo_logo"] }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
