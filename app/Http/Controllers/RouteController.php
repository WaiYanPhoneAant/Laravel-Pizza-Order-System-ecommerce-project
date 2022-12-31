<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //productlist for api
    public function productlist(){
        $productData=Product::get();
        $productList=Category::get();
        return response()->json($productData, 200);
    }
    
    public function categoryList(){
        $categoryData=Category::get();
        return response()->json($categoryData, 200);
    }
    
    public function categoryCreate(Request $request){
        Category::create($request->toArray());
        return response()->json([
            'status'=>'success'
        ], 200);

    }
    public function contactCreate(Request $request){
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,

           
        ]);
        $messages=Contact::get();
        return $messages;


        
    }
    public function categoryDelete(Request $request){

        $data=Category::where('id',$request->id)->first();
        if (isset($data)){
            $deleteData=$data->delete();
            return response()->json($data, 200);
        
        }
        
        return response()->json([
            "status"=>"404 Not found",
            "error"=>$request->id.' not found',
        ],404);


        
    }


    public function categoryEdit($id){
        $data=Category::where('id',$id)->first();
        if (isset($data)){
            return response()->json($data, 200,);
        }
        return response()->json([
            'status'=>'not found'
        ], 404);
    }

    public function categoryUpdate(Request $request){
        $id=$request->id;
        $dbSource=Category::where('id',$id)->first();
        if(isset($dbSource)){
            $data=$dbSource->update([
                'name'=>$request->update_name
            ]);
            return response()->json($dbSource, 200); 
        }
        return response()->json([
            'status'=>'something wrond'
        ], 500);

    }
}
