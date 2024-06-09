<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCommentDataTable;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Str;

class BlogController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blog.create',compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => ['required','unique:blogs,title'],
            'blog_category_id' => 'required',
            'description' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'status' => 'required',
        ]);

        $image_upload = $this->uploadImage($request,'image');
        $blog = new Blog();
        $blog->image = $image_upload;
        $blog->user_id = auth()->user()->id;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();
        toastr('Blog created successfully','success','',['ProgressBar']);
        return redirect()->route('admin.blog.index');
    }
    public function blogComment(BlogCommentDataTable $dataTable){
        $comments = BlogComment::all();
        return $dataTable->render('admin.blog.comment.index',compact('comments'));
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
        $blog = Blog::findOrFail($id);
        $blog_categories = BlogCategory::all();
        return view('admin.blog.edit',compact('blog','blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => ['required','unique:blogs,title,'.$id],
            'blog_category_id' => 'required',
            'description' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'status' => 'required',
        ]);
        $blog = Blog::findOrFail($id);
        $blog->user_id = auth()->user()->id;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        if($request->hasFile('image')){
            $image_upload = $this->uploadImage($request,'image');
            $blog->image = $image_upload;
        }
        $blog->update();
        toastr('Blog updated successfully','success','',['ProgressBar']);
        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);
        }
    }
    public function blogCommentDestroy($id){
        try{
            $comment = BlogComment::findOrFail($id);
            $comment->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>'deleted failed']);
        }
    }
}
