<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        // dd($request->all());
        $imagePath = $this->uploadImage($request,'image');

        $slider = new Slider();
        $slider->image = $imagePath ;
        $slider->offer = $request->offer;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();
        toastr('Create successfully','success');
        return to_route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.update',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);
        $imgPath = $this->uploadImage($request,'image',$slider->image);
        $slider->image = !empty($imgPath) ? $imgPath : $slider->image;
        $slider->offer = $request->offer;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();

        toastr('Updated successfully','success');

        return to_route('admin.slider.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $slider = Slider::findOrFail($id);
            $this->deleteImage($slider->image);
            $slider->delete();
            return response(['status'=>'success','message'=>'delete successfully']);
        }catch(\Exception $e){
            return response(['status'=>'error','message'=>$e->getMessage()]);

        }
    }
}
