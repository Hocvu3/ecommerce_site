<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
aria-labelledby="v-pills-home-tab">
<div class="fp_dashboard_body">
    <h3>Welcome to your Profile</h3>

    <div class="fp__dsahboard_overview">
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>total order <span>(76)</span></h4>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item green">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>Completed <span>(71)</span></h4>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item red">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>cancel <span>(05)</span></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="fp_dash_personal_info show">
        <h4>Parsonal Information
        </h4>
        <div class="fp_dash_personal_info_edit comment_input p-0">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="fp__comment_imput_single">
                            <label>name</label>
                            <input type="text" name ="name" value=" {{ auth()->user()->name }}" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="fp__comment_imput_single">
                            <label>email</label>
                            <input type="email" name = "email" value=" {{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
