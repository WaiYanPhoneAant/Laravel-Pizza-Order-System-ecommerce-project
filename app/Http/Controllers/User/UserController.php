<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{

    //user get data for home page
    public function home(){
        $pizzas=Product::get()->reverse();
        $categories=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','order'));
    }
    
    //password change page
    public function pwChangePage(){
        return view('user.password.change');
    }
    
    // change password 
    public function passwordChange(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId=Auth::user()->id;


        // get old passowrd from database
        $user=User::select('password')->where('id',$currentUserId)->first();
        $dbpw=$user->password;
        
        //get old password from users request
        $requestOld=$request->oldpassword;
        
        // get new password from user request
        $newPw=$request->Newpassword;
        
        
        if(Hash::check($requestOld,$dbpw)){
            User::where('id',$currentUserId)->update([
                'password'=>Hash::make($newPw),
            ]);
            // Auth::logout();
            return redirect()->route('password#changePage')->with(['pwChangeSuccess'=>'Password Successfully changes']);
        }else{
            return  back()->with(['notMatch'=>'Old password is wrong!!Try again.']);
        }
    }
    
    // account detail
    public function accountdetail(){
        return view('user.account.detail');
    }
    
    //account editepage
    public function accounteditPage(){
        return view('user.account.edit');

    }

    //account update page
    public function accountupdate(Request $request){
        $this->updateValidator($request);
        $currentUserId=Auth::user()->id;
        $userData=$this->getUpdateUserdata($request);

        // for image
        if($request->hasFile('image')){
            $dbImage=Auth::user()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName= uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $userData['image']=$fileName;
        }    
        User::where('id',$currentUserId)->update($userData);
        return redirect()->route('account#detail')->with(['success'=>'Successfully Updated']);
        
    }
    public function detail($id){
        $pizza=Product::where('id',$id)->first();
        $cart=Cart::where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        $products=Product::get();
        return view('user.main.detail',compact('pizza','products','cart'));
    }


    private function getUpdateUserdata($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }
    
    // validation for change password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldpassword'=>'required|min:6',
            'Newpassword'=>'required|min:6',
            'confrimPassword'=>'required|min:6|same:Newpassword'
            ])->validate();
    }


    //update user account data
    private function updateValidator($request){
        Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
                'gender'=>'required',
                'email'=>'required',
                'image'=>'mimes:png,jpg,jpeg|file|max:50000',
                
            ]
        )->validate();
    } 
}
    