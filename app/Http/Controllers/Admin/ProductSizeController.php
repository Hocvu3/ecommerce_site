<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $product_id)
    {
        $product_size = ProductSize::where('product_id',$product_id)->get();
        $product = Product::findOrFail($product_id);
        $product_option = ProductOption::where('product_id',$product_id)->get();
        return view('admin.product.size.index',compact('product','product_size','product_option'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size'=>['required','max:5000'],
            'price'=>['required','max:5000'],
            'product_id'=>['required','integer']
        ]);
        $product_size = new ProductSize();
        $product_size->name = $request->size;
        $product_size->price = $request->price;
        $product_size->product_id = $request->product_id;
        $product_size->save();

        toastr('Created successfully','success');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $image = ProductSize::findOrFail($id);
            $image->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);

        }
    }
}
