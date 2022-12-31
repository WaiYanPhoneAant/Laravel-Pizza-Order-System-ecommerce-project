<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //orderList
    public function orderList(){
        $orders=Order::when(request('search'),function($query){
                $query->orWhere('orders.order_code','like','%'.request('search').'%')
                    ->orWhere('users.name','like','%'.request('search').'%');
                   
                })
                ->select('*','users.name as user_name','orders.created_at as created_at','orders.updated_at as updated_at')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('orders.created_at','desc')
                ->paginate('4');
                $orders->appends(request()->all());
                
        return view('admin.order.orderlist',compact('orders'));

    }
    // orderInfo
    public function orderInfo($order_code){
        $orderInfo=OrderList::select('*',
                'users.name as user_name',
                'users.image as user_img',
                'order_lists.orderCode as order_code',
                'order_lists.total as total_price',
                'order_lists.created_at as ordered_date',
                'products.id as product_id',
                'products.name as product_name',
                'products.image as product_image')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_lists.orderCode',$order_code)
        ->get();
        
        return view('admin.order.orderInfo',compact('orderInfo'));

    }
}
