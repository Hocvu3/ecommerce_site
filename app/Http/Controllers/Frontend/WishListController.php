<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WishListController extends Controller
{
    public function loadWishList(Request $request,string $id){
        //handle exist one
        if(!Auth::check()){
            throw ValidationException::withMessages(['Please login first !']);
        }
        $existWishList = WishList::where(['user_id'=>auth()->user()->id,'product_id'=>$id])->exists();
        if($existWishList){
            throw ValidationException::withMessages(['Product already existed in wishlist !']);
        }
        $wishlist = new WishList();
        $wishlist->user_id=auth()->user()->id;
        $wishlist->product_id=$id;
        $wishlist->save();

        return response(['status'=>'success','message'=>'Add to wishlist successfully']);
    }
}
