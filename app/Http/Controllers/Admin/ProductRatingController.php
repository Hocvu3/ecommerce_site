<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductRatingDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function productRating(ProductRatingDataTable $dataTable){
        return $dataTable->render('admin.product.product-rating.index');
    }
    public function productDestroy(string $id){
        try{
            $rating = ProductRating::findOrFail($id);
            $rating->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
    public function productUpdate(Request $request){
        //dd($request->all());
        $rating = ProductRating::findOrFail($request->id);
        $rating->status = $request->status;
        $rating->save();
        return response(['status'=>'success','message'=>'updated successfully']);
    }
}
