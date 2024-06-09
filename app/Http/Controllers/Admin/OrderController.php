<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderDataTable $orderDataTable){
        return $orderDataTable->render('admin.order.index');
    }
    function orderEdit(string $id){
        $orders = Order::findOrFail($id);
        return view('admin.order.update',compact('orders'));
    }
    function orderUpdate(Request $request,string $id){
        $request->validate([
            'payment_status'=>['required','in:pending,completed'],
            'order_status'=>['required','in:pending,in_process,delivered,declined'],
        ]);
        $orders=Order::findOrFail($id);
        $orders->payment_status=$request->payment_status;
        $orders->order_status=$request->order_status;
        $orders->save();
        toastr('Updated sucessfully','success');
        return redirect()->back();
    }
    public function orderDestroy(string $id){
        try{
            $orders = Order::findOrFail($id);
            $orders->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);;
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
