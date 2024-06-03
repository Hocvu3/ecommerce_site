<?php
namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use Cart;

class OrderService{
    function createOrder(){
        try{
            $order = new Order();
            $order->invoice_id=generateInvoiceId();
            $order->user_id=auth()->user()->id;
            $order->address=session()->get('address');
            $order->discount=session()->get('coupon')['discount']  ?? 0;
            $order->delivery_charge=session()->get('delivery_fee');
            $order->subtotal=cartTotal();
            $order->grand_total=grandCartTotal(session()->get('delivery_fee'));
            $order->product_qty=Cart::count();
            $order->payment_method=NULL;
            $order->payment_status='pending';
            $order->payment_approve_date=NULL;
            $order->transaction_id=NULL;
            $order->coupon_info=json_encode(session()->get('coupon'));
            $order->currency_name=NULL;
            $order->order_status='pending';
            $order->delivery_area_id =  session()->get('delivery_area_id');
            $order->save();
            foreach(Cart::content() as $product){
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_name = $product->name;
                $orderItem->product_id = $product->id;
                $orderItem->unit_price = $product->price;
                $orderItem->qty = $product->qty;
                $orderItem->product_size = json_encode($product->options->product_size);
                $orderItem->product_option = json_encode($product->options->product_option);
                $orderItem->save();
            }
            //put order id to session
            session()->put('order_id',$order->id);
            //put grand total
            session()->put('grand_total',$order->grand_total);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    //clear session from items
    function clearSession(){
        \Cart::destroy();
        session()->forget('coupon');
        session()->forget('address');
        session()->forget('delivery_fee');
        session()->forget('grand_total');
        session()->forget('delivery_area_id');
        session()->forget('order_id');
        session()->forget('grand_total');
    }
}
