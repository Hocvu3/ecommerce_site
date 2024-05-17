<div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
aria-labelledby="v-pills-settings-tab">
<div class="fp_dashboard_body fp__change_password">
    <div class="fp__review_input">
        <h3>change password</h3>
        <div class="comment_input pt-0">
            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-6">
                        <div class="fp__comment_imput_single">
                            <label>Current Password</label>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="fp__comment_imput_single">
                            <label>New Password</label>
                            <input type="password" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="fp__comment_imput_single">
                            <label>confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <button type="submit"
                            class="common_btn mt_20">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
