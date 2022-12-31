<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contactPage
    public function contactPage(){
        return view('user.contact.contact');
    }

    //contactSend
    public function contactSend(Request $request){
        
        Validator::make($request->toArray(),[
            'name'=>['required'],
            'email'=>['required'],
            'message'=>['required']  
        ])->validate();

        Contact::create(
            $request->toArray(),
        );
        return redirect()->route('user#home');
    }

    //customerMailList
    public function customerMailList(){
        $mailDatas=Contact::when(request('search'),function($query){
            $query->orWhere('name','like','%'.request('search').'%')
                    ->orWhere('email','like','%'.request('search').'%')
                    ->orWhere('message','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate('2');
        $mailDatas->appends(request()->all());
        return view('admin.customer.mailList',compact('mailDatas'));
    }
}
