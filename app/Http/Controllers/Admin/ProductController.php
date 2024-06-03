<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $thumbnail_image = $this->uploadImage($request,'image');
        $products = new Product();
        $products->thumbnail_image = $thumbnail_image;
        $products->name = $request->name;
        $products->slug = generateUniqueSlug('Product',$request->name);
        $products->category_id = $request->category_id;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->quantity = $request->quantity;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->sku = $request->sku;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->show_at_home = $request->show_at_home;
        $products->status = $request->status;
        //dd($products);
        $products->save();

        toastr('Created successfully','success');
        return to_route('admin.product.index');
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
        $categories = Category::all();
        $products = Product::findOrFail($id);
        return view('admin.product.update',compact('categories','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Product::findOrFail($id);
        $thumbnail_image = $this->uploadImage($request,'image',$products->thumbnail_image);
        $products->thumbnail_image = !empty($thumbnail_image)? $thumbnail_image : $products->thumbnail_image;
        $products->name = $request->name;
        //$products->slug = generateUniqueSlug('Product',$request->name);
        $products->category_id = $request->category_id;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->quantity = $request->quantity;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->sku = $request->sku;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->show_at_home = $request->show_at_home;
        $products->status = $request->status;
        //dd($products);
        $products->save();

        toastr('Updated successfully','success');
        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::findOrFail($id);
            $this->deleteImage($product->thumbnail_image);
            $product->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);

        }
    }
}
