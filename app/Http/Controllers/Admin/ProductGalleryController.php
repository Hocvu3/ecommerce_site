<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FileUploadTrait;
    public function index(string $product_id)
    {
        $product_gallery = ProductGallery::where('product_id',$product_id)->get();
        $product = Product::findOrFail($product_id);
        return view('admin.product.gallery.index',compact('product_id','product_gallery','product'));
        //dd($product_id);
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
            'image'=>['required','image','max:5000'],
            //'product_id'=>['required','integer']
        ]);
        //dd($request->all());
        $imagePath = $this->uploadImage($request,'image');
        $gallery = new ProductGallery();
        $gallery->image = $imagePath;
        $gallery->product_id = $request->product_id;
        //dd($gallery);
        $gallery->save();

        toastr('Updated successfully','success');
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
    public function destroy(string $id) : HttpResponse
    {
        try{
            $image = ProductGallery::findOrFail($id);
            $this->deleteImage($image->image);
            $image->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);

        }
    }
}
