<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'option'=>['required','max:5000'],
            'price'=>['required','max:5000'],
            'product_id'=>['required','integer']
        ]);
        $product_option = new ProductOption();
        $product_option->name = $request->option;
        $product_option->price = $request->price;
        $product_option->product_id = $request->product_id;
        $product_option->save();

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
            $image = ProductOption::findOrFail($id);
            $image->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);

        }
    }
}
