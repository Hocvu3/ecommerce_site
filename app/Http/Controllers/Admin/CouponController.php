<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponCreateRequest;
use App\Http\Requests\Admin\CouponUpdateRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponCreateRequest $couponCreateRequest)
    {
        $coupon = new Coupon();
        $coupon->name = $couponCreateRequest->name;
        $coupon->code = $couponCreateRequest->code;
        $coupon->quantity = $couponCreateRequest->quantity;
        $coupon->min_purchase_amount = $couponCreateRequest->min_purchase_amount;
        $coupon->expire_date = $couponCreateRequest->expire_date;
        $coupon->discount_type= $couponCreateRequest->discount_type;
        $coupon->discount = $couponCreateRequest->discount;
        $coupon->status = $couponCreateRequest->status;
        $coupon->save();
        toastr()->success('Added successfully');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$categories = Category::all();
        $coupons = Coupon::findOrFail($id);
        return view('admin.coupon.update',compact('coupons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $couponCreateRequest, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->name = $couponCreateRequest->name;
        $coupon->code = $couponCreateRequest->code;
        $coupon->quantity = $couponCreateRequest->quantity;
        $coupon->min_purchase_amount = $couponCreateRequest->min_purchase_amount;
        $coupon->expire_date = $couponCreateRequest->expire_date;
        $coupon->discount_type= $couponCreateRequest->discount_type;
        $coupon->discount = $couponCreateRequest->discount;
        $coupon->status = $couponCreateRequest->status;
        $coupon->save();
        toastr()->success('Updated successfully');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Coupon::findOrFail($id)->delete();
            return response(['status'=>'success','message'=>'Deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'Attempt failed']);
        }
    }
}
