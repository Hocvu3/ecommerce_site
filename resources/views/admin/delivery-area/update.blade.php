@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Area</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.delivery-area.update',$delivery_area->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Area Name</label>
                        <input type="text" name="area_name" value="{{$delivery_area->area_name}}" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Min Delivery Time</label>
                                <input type="text" name="min_delivery_time" value="{{$delivery_area->min_delivery_time}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Max Delivery Time</label>
                                <input type="text" name="max_delivery_time" value="{{$delivery_area->max_delivery_time}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Fee</label>
                                <input type="text" name="delivery_fee" value="{{$delivery_area->delivery_fee}}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" id="">
                                    <option {{ $delivery_area->status === '1' ? 'selected' : '' }} value="1">1</option>
                                    <option {{ $delivery_area->status === '0' ? 'selected' : '' }} value="0">0</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
    </script>
@endpush
