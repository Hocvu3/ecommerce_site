<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryAreaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryAreaCreateRequest;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DeliveryAreaDataTable $deliveryAreaDataTable)
    {
        return $deliveryAreaDataTable->render('admin.delivery-area.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.delivery-area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryAreaCreateRequest $request)
    {
        $deliveryArea = new DeliveryArea();
        $deliveryArea->area_name=$request->area_name;
        $deliveryArea->min_delivery_time=$request->min_delivery_time;
        $deliveryArea->max_delivery_time=$request->max_delivery_time;
        $deliveryArea->delivery_fee=$request->delivery_fee;
        $deliveryArea->status=$request->status;
        $deliveryArea->save();
        toastr('Created successfully','success');
        return redirect()->route('admin.delivery-area.index');
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
        $delivery_area = DeliveryArea::findOrFail($id);
        return view('admin.delivery-area.update',compact('delivery_area'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryAreaCreateRequest $request, string $id)
    {
        $deliveryArea = DeliveryArea::findOrFail($id);
        $deliveryArea->area_name=$request->area_name;
        $deliveryArea->min_delivery_time=$request->min_delivery_time;
        $deliveryArea->max_delivery_time=$request->max_delivery_time;
        $deliveryArea->delivery_fee=$request->delivery_fee;
        $deliveryArea->status=$request->status;
        $deliveryArea->save();
        toastr('Updated successfully','success');
        return redirect()->route('admin.delivery-area.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$deliveryArea = DeliveryArea::findOrFail($id);
        try{
            DeliveryArea::findOrFail($id)->delete();
            return response(['status'=>'success','message'=>'Deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'Attempt failed']);
        }
    }
}
