<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordUpdateRequest;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;
    public function updateProfile(ProfileUpdateRequest $request):RedirectResponse{
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        toastr('Profile updated successfully','success');
        return redirect()->back();
    }
    // dd($request->all());
    // }
    public function updatePassword(ProfilePasswordUpdateRequest $request):RedirectResponse{
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        toastr('Password changed successfully','success','',
        [
            'ProgressBar'=>'true',
            'closeButton'=>'true',
        ]);
        return redirect()->back();
    }

    public function updateAvatar(Request $request){
        $imagePath = $this->uploadImage($request,'avatar');
        $user = Auth::user();
        $user->avatar = $imagePath;
        $user->save();
        return response(['status'=>'success','message'=>'avatar update success']);
    }
}
