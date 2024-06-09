<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::where('status', 1);
        if($request->has('search')&& $request->filled('search')){
            $blogs->where(function($q) use($request){
                $q->where('title','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%');
            });
        }
        $blogs = $blogs->withCount(['comments' => function ($q) {
            $q->where('status', 1);
        }])
        ->where('status', 1)->paginate(9);
        //dd($blogs);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function show(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->withCount('comments')->first();
        $related_blogs = Blog::where('status', 1)->where('id', '!=', $blog->id)->limit(3)->get();
        $categories = BlogCategory::where('status', 1)->withCount(['blog' => function ($q) {
            $q->where('status', 1);
        }])->get();
        //dd($categories);
        $next_blog = Blog::where('status', 1)->where('id', '>', $blog->id)->first();
        $prev_blog = Blog::where('status', 1)->where('id', '<', $blog->id)->first();
        //comment
        $blog_comments = BlogComment::where('blog_id', $blog->id)->paginate(5);
        //dd($blog);
        return view('frontend.pages.blog-details', compact('blog', 'related_blogs', 'categories', 'categories', 'next_blog', 'prev_blog', 'blog_comments'));
    }
    public function sendMessage(Request $request)
    {
        //yeu cau dang nhap
        if (!Auth::check()) {
            throw ValidationException::withMessages(['Please login first !']);
        }
        //validate
        $request->validate([
            'message' => 'required'
        ]);
        // dd($request->all());
        $comment = new BlogComment();
        $comment->blog_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->message;
        $comment->save();
        return response(['status' => 'success', 'message' => 'You have been commented!'], 200);
    }
}
