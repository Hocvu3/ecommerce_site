@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Coupon</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <label>Create</label>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Minimum Purchase Amount</label>
                        <input type="text" name="min_purchase_amount" value="{{ old('min_purchase_amount') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" name="expire_date" value="{{ old('expire_date') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Discount Type</label>
                        <select name="discount_type" class="form-control" id="">
                            <option value="Percent">Percent(%)</option>
                            <option value="Amount">Amount($)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="text" name="discount" value="{{ old('discount') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">DeActive</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
