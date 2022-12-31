<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    // change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    // change password 
    public function changePassword(Request $request){
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
            return redirect()->route('admin#changePasswordPage')->with(['pwChangeSuccess'=>'Password Successfully changes']);
        }else{
            return  back()->with(['notMatch'=>'Old password is wrong!!Try again.']);
        }
    }

    public function detail(){
        return view('admin.account.detail');
    }

    public function edit(){
        return view('admin.account.edit');
    }

    //admin list
    public function list(){
        $admin=User::when(request('search'),function($query){
            $query->orwhere('name','like','%'.request('search').'%')
                  ->orwhere('address','like','%'.request('search') .'%')
                  ->orwhere('email','like','%'.request('search') .'%')
                  ->orwhere('phone','like','%'.request('search') .'%')
                  ->orwhere('gender',request('search'));
        })
        ->where('role','admin')->paginate('2');
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin acc delete
    public function delete($id){
        if(Auth::user()->id==$id){
            return abort('404');
        }else{
            User::where('id',$id)->delete();
            return back()->with(['deleteSuccess'=>'Success Delete....']);
        }
    }

    //admin role page
    public function rolePage($id){
        $admin=User::where('id',$id)->first();
        return view('admin.account.role',compact('admin'));
    }

    //role update
    public function roleupdate(Request $request,$id){
        User::where('id',$id)->update(['role'=>$request->role]);
        return redirect()->route('admin#list')->with(['updateSuccess'=>'Role successfully change']);
    }

    
    // to update admin user data
    public function update(Request $request){
        $this->updateValidator($request);
        $currentUserId=Auth::user()->id;
        $userData=$this->getUpdateUserdata($request);
        // for image
        if($request->hasFile('image')){
            // $dbImage=User::where('id',$currentUserId)->first();
            $dbImage=Auth::user()->image;
            
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName= uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $userData['image']=$fileName;
        }    
        User::where('id',$currentUserId)->update($userData);
        return redirect()->route('admin#details')->with(['success'=>'Successfully Updated']);
        
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



    // customerList for admin page
    public function customerList(){
        $users=User::when(request('search'),function($query){
            $query->orwhere('name','like','%'.request('search').'%')
                  ->orwhere('address','like','%'.request('search') .'%')
                  ->orwhere('email','like','%'.request('search') .'%')
                  ->orwhere('phone','like','%'.request('search') .'%')
                  ->orwhere('gender',request('search'));
        })
        ->where('role','user')->paginate('4');
        $users->appends(request()->all());

        return view('admin.customer.customerlist',compact('users'));
    }



    // validation for change password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldpassword'=>'required|min:6',
            'Newpassword'=>'required|min:6',
            'confrimPassword'=>'required|min:6|same:Newpassword'
        ])->validate();
    }

    //update admin data
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



