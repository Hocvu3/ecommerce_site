<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactIndex(){
        $contact = Contact::first();
        return view('admin.contact.index',compact('contact'));
    }
    public function contactUpdate(Request $request){
        $request->validate([
            'phone_one' => ['numeric','required'],
            'phone_two' => 'numeric',
            'email_one' => 'required',
            'email_two' => 'email',
            'address' => 'required',
           // 'map_link' => 'long_description',
        ]);
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'mail_one' => $request->email_one,
                'mail_two' => $request->email_two,
                'address' => $request->address,
                'map_link' => $request->map_link
            ]
            );
        toastr()->success('Updated successfully');
        return redirect()->back();
    }
}
