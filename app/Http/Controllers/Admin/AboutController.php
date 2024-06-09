<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        $abouts = About::first();
        return view('admin.about.index',compact('abouts'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_logo' => 'image',
            'title' => 'required',
            'main_title' => 'required',
            'description' => 'required',
            'video_link' => 'required',
        ]);
        $imagePath = $this->uploadImage($request, 'about_logo', $request->old_about_logo);
        About::updateOrCreate(
            ['id' => 1],
            [
                'image' => !empty($imagePath) ? $imagePath : $request->old_about_logo,
                'title' => $request->title,
                'main_title' => $request->main_title,
                'description' => $request->description,
                'video_link' => $request->video_link,
            ]
        );
        toastr('Updated successfully', 'success');
        return redirect()->back();
    }
}
