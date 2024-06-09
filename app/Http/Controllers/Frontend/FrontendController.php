<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\Slider;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{
    public function index(Request $request) :View{
        $sliders = Slider::where('status',1)->get();
        $categories = Category::where(['show_at_home'=>1,'status'=>1])->get();
        $blogs = Blog::withCount(['comments' => function ($q) {
            $q->where('status', 1);
        }])
        ->where('status', 1)->limit(3)->get();
        return view('frontend.home.index',compact('sliders','categories','blogs'));
    }
    public function showMenu(Request $request){
        $products = Product::with(['productImages','productSizes','productOptions'])
        ->where('status',1)
        ->orderBy('id', 'DESC');

        if($request->has('search')&& $request->filled('search')){
            $products->where(function($q) use($request){
                $q->where('name','like','%'.$request->search.'%')
                ->orWhere('long_description','like','%'.$request->search.'%');
            });
        }

        if($request->has('category')&& $request->filled('category')){
            $products->whereHas('category',function($q) use($request){
                $q->where('slug',$request->category);
            });
        }

        $products = $products->withAvg('productRatings', 'rating')->withCount('productRatings')->paginate(10);
        $categories = Category::where(['status'=>1])->get();
        return view('frontend.pages.menu',compact('products','categories'));
    }
    public function reviewStore(Request $request){
        //validate lay one
        $request->validate([
            'rating'=>['required','integer','min:1','max:5'],
            'review'=>['required','max:500'],
        ]);
        //validate layer 2
        $user = Auth::user();
        $hasPurchased = $user->orders()->whereHas('order_item',function($q) use($request){
            $q->where('product_id',$request->product_id);
        })
        ->where('order_status','delivered')
        ->get();
        //dd($hasPurchased);
        if(count($hasPurchased) == 0){
            throw ValidationException::withMessages(['Please buy this product first']);
        }
        //validate layer 3
        $alreadyReviewed = ProductRating::where(['user_id'=>$user->id,'product_id'=>$request->product_id])->exists();
        if($alreadyReviewed){
            throw ValidationException::withMessages(['You have already reviewed this product']);
        }
        $productRating = new ProductRating();
        $productRating->user_id = $user->id;
        $productRating->product_id = $request->product_id;
        $productRating->rating = $request->rating;
        $productRating->comment = $request->review;
        $productRating->save();
        toastr('Reviewed successfully','success');
        return redirect()->back();
    }
    public function showProduct(string $slug){
        $product = Product::with(['productImages','productSizes','productOptions'])
            ->where(['slug'=>$slug,'status'=>1])
            ->withAvg('productRatings', 'rating')
            ->withCount('productRatings')
            ->firstOrFail();
        $relatedProduct = Product::where('category_id',$product->category_id)
        ->where('id','!=',$product->id)
        ->withAvg('productRatings', 'rating')
        ->withCount('productRatings')
        ->take(8)
        ->latest()
        ->get();
        $ratings = ProductRating::where(['product_id'=>$product->id,'status'=>1])->get();
        //dd($relatedProduct);
        return view('frontend.pages.product-view',compact('product','relatedProduct','ratings'));
    }
    public function loadProductModal($productId){
        //return $productId;
        $product = Product::with(['productSizes','productOptions'])->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal',compact('product'))->render();
    }

}
