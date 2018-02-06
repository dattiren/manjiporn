<?php

namespace App\Http\Controllers;

use Mail;
use App\Contact;
use App\Mail\ContactSent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function form(){
        return view('contact.form');
    }

    public function confirm(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'present',
            'comments' => 'present',
        ]);
        // formから値を取得
        $contact = new Contact($request->all());
        // 変数contactをconfirmのviewに渡す
        return view('contact.confirm', compact('contact'));
    }

    public function process(Request $request){
        $action = $request->get('action', 'back');
        $input = $request->except('action');
        if($action === 'submit') {
            $contact = Contact::make($request->all());
            Mail::to('manjiporn@gmail.com')->send(new ContactSent($contact));
            return view('contact.complete');
        }else{
            return redirect()->action('ContactController@form')
                ->withInput($input);
        }
    }
}
