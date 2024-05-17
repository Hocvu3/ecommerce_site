<?php

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait FileUploadTrait{
    function uploadImage(Request $request,$inputName,$oldImgPath=NUll,$path='/uploads'){
        if($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path),$imageName);

            //delete
            if($oldImgPath && File::exists(public_path($oldImgPath))){
                File::delete(public_path($oldImgPath));
            }
            return $path.'/'.$imageName;
        }
        return NULL;
    }
    function deleteImage(string $path): void{
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
