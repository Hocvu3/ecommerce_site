<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $blogCategoryDataTable)
    {
        return $blogCategoryDataTable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:blog_categories,name'],
            'status' => 'required'
        ]);
        $blog_categories = new BlogCategory();
        $blog_categories->name = $request->name;
        $blog_categories->slug = Str::slug($request->name);
        $blog_categories->status = $request->status;
        $blog_categories->save();

        toastr('Blog Category created successfully','success');
        return redirect()->route('admin.blog-category.index');
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
        $blog_categories = BlogCategory::find($id);
        return view('admin.blog.blog-category.update',compact('blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','unique:blog_categories,name,'.$id],
            'status' => 'required'
        ]);
        $blog_categories = BlogCategory::find($id);
        $blog_categories->name = $request->name;
        $blog_categories->slug = Str::slug($request->name);
        $blog_categories->status = $request->status;
        $blog_categories->save();

        toastr('Blog Category updated successfully','success');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $blog_categories = BlogCategory::find($id);
            $blog_categories->delete();
            return response(['status'=>'success','message'=>'deleted successfully']);
        }catch(\Exception $e){
            toastr($e->getMessage(),'error');
            return response(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
