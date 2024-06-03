<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $userAddresses = Address::where('user_id',auth()->user()->id)->get();
        $deliveryAreas = DeliveryArea::where('status',1)->get();
        return view('frontend.pages.checkout',compact('userAddresses','deliveryAreas'));
    }
    public function checkoutCal(string $id){
        try{
            $address = Address::findOrFail($id);
            $fee_amount = $address->delivery_area?->delivery_fee;
            $finalTotal = grandCartTotal($fee_amount);
            return response(['delivery_fee'=>$fee_amount,'final_amount'=>$finalTotal]);
        }catch(Exception $e){
            return response(['status'=>'error','message'=>'attempt failed'],422);
        }
    }
    public function checkoutRedirect(Request $request){
        $request->validate([
            'id' => ['required','integer'],
        ]);
        $address = Address::with('delivery_area')->findOrFail($request->id);
        $selectedAddress = $address->address.',Area'. $address->delivery_area?->area_name;
        session()->put('address',$selectedAddress);
        session()->put('delivery_fee',$address->delivery_area->delivery_fee);
        session()->put('delivery_area_id',$address->delivery_area->id);
        return response(['redirect_url'=>route('payment.index')]);
    }
}
