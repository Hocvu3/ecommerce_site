@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Coupon</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupon.update',$coupons->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $coupons->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" value="{{ $coupons->code }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" name="quantity" value="{{ $coupons->quantity }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Minimum Purchase Amount</label>
                        <input type="text" name="min_purchase_amount" value="{{ $coupons->min_purchase_amount }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" name="expire_date" value="{{ $coupons->expire_date }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Discount Type</label>
                        <select name="discount_type" class="form-control" id="">
                            <option {{ $coupons->discount_type === 'Percent' ? 'selected' : '' }} value="Percent">Percent(%)</option>
                            <option {{ $coupons->discount_type === 'Amount' ? 'selected' : '' }} value="Amount">Amount($)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="text" name="discount" value="{{ $coupons->discount }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ $coupons->status === '1' ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $coupons->status === '0' ? 'selected' : '' }} value="0">DeActive</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
