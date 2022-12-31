<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories=Category::when(request('search'),function($query)
            {
                $query->where('name','like','%'. request('search') .'%');
            })
            ->orderBy('id','desc')
            ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    // create category data
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $categoary=$this->createCategory($request);
        Category::create($categoary);
        return redirect()->route('category#list')->with(['createSuccess'=>'Success Create']);;
    }

    
    // delete category data
    public function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Success Delete']);
    }

    // to show edit page
    public function editpage($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
     }


      // to update category data
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $categoary=$this->createCategory($request);
        Category::where('id',$request->category_id)->update($categoary);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Success Updating']);;
     }


    // to check validataion for category creation,
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>"required|unique:categories,name,$request->category_id",
        ],
        [
            'categoryName.required'=>'Need to fill Category Name',
            'categoryName.unique'=>'this category name is already exists',
        ])->validate();
    }

    //to create category data
    private function createCategory($request){
        return[
            'name'=>$request->categoryName
         ];
    }
   

}
