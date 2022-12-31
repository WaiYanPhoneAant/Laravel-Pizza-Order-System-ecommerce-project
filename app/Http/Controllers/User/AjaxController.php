<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller{

    //ajax get pizza list
    public function pizzaList(Request $request){
        if($request->status=='desc'){
            $data =Product::orderBy('created_at','desc')->get();
        }else{
            $data =Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }
    
    
    //ajax category filter
    public function filter(Request $request){
        $data=Product::where('category_id',$request->id)->get();
        return $data;  
    }
    

    // ajax add to cart
    public function AddtoCart(Request $request){
        $cart=Cart::where('user_id',Auth::user()->id)->where('product_id',$request->pizza_id);
        $cartData=$cart->first();               
        if($cartData){
            $cart->update([
                'qty'=>$request->count
            ]);;
        }else{
            $order=$this->getOrderData($request);
            Cart::create($order);
        }
        $response=[
            'status'=>'success',
            'message'=>'Successfull added',
        ];
        return response()->json($response,200);
    }
    

    // order creat and clear cart 
    public function order(Request $request){
        $total_price=0+30;
        foreach ($request->all() as $item) {
            $data=OrderList::create($item);
            $total_price+=$item['total'];
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->orderCode,
            'total_price'=>$total_price,
        
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'order complete'
        ],200);
    }


    // clearAllCarts items
    public function clearAllCarts(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status'=>true,
            'message'=>'complete clear all carts'
        ],200);
    }


    //Clear item by one item
    public function ClearOneItemCart(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->product_id)
            ->delete();
            return response()->json([
                'status'=>true,
                'message'=>'complete clear cart item'
            ],200);
    }



    // filterStatus
    public function filterStatus(Request $request){
        $order=Order::select('*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id');
        if($request->status!='all'){
            $order=$order->where('status',$request->status)->get();
        }else{
            $order=$order->get();
        }
        return $order;   
    }



    // statusUpdate
    public function statusUpdate(Request $request){
        $status=Order::where('order_code',$request->order_code)
                ->update(['status'=>$request->status]);
        return response()->json([
                'status'=>true,
            ],200
        );
    }



    //user Role change
    public function rolechange(Request $request){
        $users=User::where('id',$request->user_id)
                ->update(['role'=>$request->status,]);
        return response()->json([
            'status'=>true
            ],200);
    }



    //view count
    public function viewcount(Request $request){
        $product=Product::where('id',$request->product_id)->first();
        $view=$product->view_count+1;
        Product::where('id',$request->product_id)->update([
            'view_count'=>$view
        ]);
        
    }


    // get order data
    private function getOrderData($request){
        return[
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->pizza_id,
            'qty'=>$request->count,
        ];
    }
    
}
    