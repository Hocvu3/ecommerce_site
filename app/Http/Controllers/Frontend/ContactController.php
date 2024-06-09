<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index(){
        $contact = Contact::first();
        return view('frontend.pages.contact',compact('contact'));
    }
    public function sendMessage(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        //dd(config('mail'));
        try {
            Mail::send(new ContactMail($request->name,$request->email,$request->subject,$request->message));
            return response(['status' => 'success','message' => 'Message sent successfully'],200);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
