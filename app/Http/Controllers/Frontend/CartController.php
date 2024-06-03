<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function cartIndex(){
        return view('frontend.pages.cart-view');
    }
    public function cartUpdate(Request $request){
        $cart = Cart::get($request->rowId);
        $product = Product::findOrFail($cart->id);
        if($product->quantity<$request->qty){
            return response(['status'=>'error','message'=>'Stock quantity is not enough to proceed. Remaining quantity: '.$product->quantity,'product_total'=>cartProductTotal($request->rowId),'qty'=>$cart->qty]);
        }
       try{
        Cart::update($request->rowId,$request->qty);
        return response([
            'product_total'=>cartProductTotal($request->rowId),
            'total'=>cartTotal(),
            'product_quantity'=>$product->quantity,
            'grand_cart_total'=>grandCartTotal(),
        ],200);
       }catch(\Exception $e){
        return response(['status'=>'error','message'=>'updated failed'],500);
       }
    }
    public function applyCoupon(Request $request){
        $subtotal = $request->subtotal;
        //dd($subtotal);
        $coupon = Coupon::where('code',$request->code)->first();
        if(!$coupon){
            return response(['status'=>'error','message'=>'Invalid coupon code'],422);
        };
        if($coupon->quantity<=0){
            return response(['status'=>'error','message'=>'Sorry coupon is out!'],422);
        };
        if($coupon->expire_date<now()){
            return response(['status'=>'error','message'=>'Sorry coupon expired!'],422);
        };

        if($coupon->discount_type==='percent'){
            $discount = $subtotal *($coupon->discount/100);
        }elseif ($coupon->discount_type==='amount'){
            $discount = $coupon->discount;
        };
        $finalTotal = $subtotal - $discount;
        session()->put('coupon',['code'=>$coupon->code,'discount'=>$discount]);
        return response(['message'=>'Applied','finalTotal'=>$finalTotal,'discount'=>$discount,'coupon_code'=>$coupon->code]);
    }
    public function destroyCoupon(){
        try{
            session()->forget('coupon');
            return response([
            'message'=>'coupon removed successfully',
            'grand_cart_total'=>grandCartTotal()
            ]);
        }catch(Exception $e){
            return response([
                'message'=>'Attempt failed'
                ]);
        }
    }
    public function addToCart(Request $request)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
        if($product->quantity<$request->quantity){
            throw ValidationException::withMessages(['Stock quantity is not enough to proceed. Remaining quantity: '.$product->quantity]);
        }
        try {
            //dd($product);
            $productSize = $product->productSizes->where('id', $request->product_size)->first();
            $productOption = $product->productOptions->whereIn('id', $request->product_option);
            // dd($product);
            $options = [
                'product_size' => [],
                'product_option' => [],
                'product_info' => [
                    'image' => $product->thumbnail_image,
                    'slug' => $product->slug
                ]
            ];
            if ($productSize !== null) {
                $options['product_size'] = [
                    'id' => $productSize?->id,
                    'name' => $productSize?->name,
                    'price' => $productSize?->price
                ];
            }
            foreach ($productOption as $option) {
                $options['product_option'][] = [
                    'id' => $option?->id,
                    'name' => $option?->name,
                    'price' => $option?->price
                ];
            }
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => 0,
                'options' => $options,
            ]);
            return response(['status' => 'success', 'message' => 'add to cart successfully','total'=>cartTotal()], 200);
        } catch (\Exception $e) {
            logger($e);
            response(['status' => 'error', 'message' => 'try again'],500);
        }
    }
    public function getCartProduct(){
        $product = Cart::content();

        return view('frontend.layouts.ajax-files.sidebar-cart')->render();
    }
    public function removeCartProduct($rowId){
        try{
            Cart::remove($rowId);
            return response([
                'status'=>'success',
                'message'=>'removed successfully',
                'total'=>cartTotal(),
                'grand_cart_total'=>grandCartTotal(),
            ],200);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'sorry something went wrong'],500);

        }
    }
    public function cartDestroy(){
            Cart::destroy();
            session()->forget('coupon');
            toastr('all has been removed successfully','success');
            return redirect()->back();
    }
}
