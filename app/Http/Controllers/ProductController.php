<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //products list
    public function list(){
        $products=Product::select('products.*','categories.name as category_name')
            ->when(request('search'),function($query){
            $query->where('products.name','like','%'. request('search') .'%');
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.id','desc')
            ->paginate(3);
        $products->appends(request()->all());
        return view('admin.products.pizzalist',compact('products'));
    }

    //create productPage
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }
    public function create(Request $request){
        $this->createValidator($request,'create');
        $productData=$this->getProductdata($request);
        if($request->hasFile('image')){
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $productData['image']=$fileName;
        }

        Product::create($productData);
        return redirect()->route('products#list')->with(['Success'=>'Success Product Creation']);
    }

    public function delete($id){
        $product=Product::where('id',$id)->first();
        $product->delete();
        if($product->image != null){
            Storage::delete('public/'.$product->image);
        }
        return redirect()->route('products#list')->with(['Deletesuccess'=>'Success Delete']);      
    }

    //product detail
    public function detail($id){
        $product=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.detail',compact('product'));
    }


    //product updatePage
    public function updatePage($id){
        $product=Product::where('id',$id)->first();
        $categories=Category::select('id','name')->get();
        return view('admin.products.update_page',compact('product','categories'));
    }

     //product update(action)
     public function update(Request $request,$id){
        $updateData=$this->getProductdata($request);
        $this->createValidator($request,'update');
        if($request->hasFile('image')){
            $dbImage=Product::where('id',$id)->first();
            
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName= uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $updateData['image']=$fileName;
        }   
        Product::where('id',$id)->update($updateData);
        return back()->with(['success'=>'Update Successed']);
        
    }
    
    // get create products data
    private function getProductdata($request){
        return[
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'waiting_time'=>$request->waiting_time,
        ];
    }

    private function createValidator($request,$action){
        $validate=[
            'name'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'description'=>'required',
            'waiting_time'=>'required',

            
        ];
        $normal_req_img='mimes:png,jpg,jpeg|file|max:50000';
        $action=="create"? $validate['image']='required|'.$normal_req_img:$validate['image']=$normal_req_img;
        Validator::make(
            $request->all(),$validate   
        )->validate();
    } 
}
