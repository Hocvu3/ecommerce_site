<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        return view('frontend.pages.about',compact('about'));
    }
}
