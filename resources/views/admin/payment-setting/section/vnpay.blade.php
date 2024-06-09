<div class="tab-pane fade show active" id="vnpay-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.vnpay-payment-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Vnpay Status</label>
                    <select name="vnpay_status" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['vnpay_status'] == 1) value="1">Active</option>
                        <option @selected(@$paymentGateway['vnpay_status'] == 0) value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Vnpay Account Mode</label>
                    <select name="vnpay_account_mode" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['vnpay_account_mode'] === 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(@$paymentGateway['vnpay_account_mode'] === 'live') value="live">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Parter Code (TMN CODE)</label>
                    <input type="text" value="{{ @$paymentGateway['vnpay_partner_code'] }}" name="vnpay_partner_code" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Hash Secret</label>
                    <input type="text" value="{{ @$paymentGateway['vnpay_hash_secret'] }}" name="vnpay_hash_secret" class="form-control">
                </div>
                <div class="form-group">
                    <label>Momo Logo</label>
                    <div id="image-preview" class="image-preview vnpay-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="vnpay_logo" id="image-upload" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.vnpay-preview').css({
                'background-image': 'url({{ @$paymentGateway["vnpay_logo"] }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
