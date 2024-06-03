<div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
    <div class="fp_dashboard_body address_body">
        <h3>address <a class="dash_add_new_address"><i class="far fa-plus"></i> add new
            </a>
        </h3>
        <div class="fp_dashboard_address">
            <div class="fp_dashboard_existing_address">
                <div class="row">
                    @foreach ($userAddresses as $userAddress)
                        <div class="col-md-6">
                            <div class="fp__checkout_single_address">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <span class="icon">
                                            @if ($userAddress->type === 'home')
                                                <i class="fas fa-home"></i>
                                            @else
                                                <i class="fas fa-car-building"></i>
                                            @endif
                                            {{ $userAddress->type }}
                                        </span>
                                        <span class="address">{{ $userAddress->address }},
                                            {{ $userAddress->delivery_area?->area_name }}</span>
                                    </label>
                                </div>
                                <ul>
                                    <li><a class="dash_edit_btn show_edit_section" data-class="edit_section_{{ $userAddress->id }}"><i class="far fa-edit"></i></a></li>
                                    <li><a href="{{ route('address.destroy',$userAddress->id) }}" class="dash_del_icon delete-item"><i class="fas fa-trash-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="fp_dashboard_new_address ">
                <form action="{{ route('address.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- //@method('PUT') --}}
                    <div class="row">
                        <div class="col-12">
                            <h4>add new address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <select id="select_js3" name="area">
                                    @foreach ($deliveryAreas as $deliveryArea)
                                        <option value="{{ $deliveryArea->id }}">{{ $deliveryArea->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="First Name *" name="first_name">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Last Name" name="last_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Phone *" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="email" placeholder="Email *" name="email">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="home"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="office"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address">cancel</button>
                            <button type="submit" class="common_btn">save
                                address</button>
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($userAddresses as $address)
            <div class="fp_dashboard_edit_address edit_section_{{ $address->id }}">
                {{-- {{ route('address.update',$userAddresses->id) }} --}}
                <form action="{{ route('address.update',$address->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <h4>edit address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <select class="nice_select" name="area">
                                    @foreach ($deliveryAreas as $deliveryArea)
                                        <option {{ $address->delivery_area_id === $deliveryArea->id ? 'selected' : ''}} value="{{ $deliveryArea->id }}">{{ $deliveryArea->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="First Name *" name="first_name" value="{{ $address->first_name }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Last Name" name="last_name" value="{{ $address->last_name }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Phone *" name="phone" value="{{ $address->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="email" placeholder="Email *" name="email" value="{{ $address->email }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Address" name="address">{{ $address->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input {{ $address->type === 'home' ? 'checked' : '' }} class="form-check-input" type="radio" name="type" value = "home"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input @checked($address->type === 'office') class="form-check-input" type="radio" name="type" value = "office"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_edit_address">cancel</button>
                            <button type="submit" class="common_btn">save
                                address</button>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('.show_edit_section').on('click',function(){
            let className = $(this).data('class');
            $('.'+className).addClass('d-block');
            $('.fp_dashboard_edit_address').removeClass('d-block');
            $('.fp_dashboard_edit_address').removeClass('d-none');
            $('.fp_dashboard_existing_address').addClass('d-none');
            $('.'+className).addClass('d-block');
        })
        $('.cancel_edit_address').on('click',function(){
            $('.fp_dashboard_edit_address').addClass('d-none');
            $('.fp_dashboard_existing_address').removeClass('d-none');
        })
    })
</script>
@endpush
