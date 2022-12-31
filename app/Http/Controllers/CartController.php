<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cartList
    public function cartList(){
        $cartList=Cart::where('carts.user_id',Auth::user()->id)
                ->select('carts.*','products.price','products.name','products.id as product_id','products.image as image')
                ->leftJoin('products','carts.product_id','products.id')
                ->get()
                ->reverse();
        $totalprice=array_reduce($cartList->toArray(),function($fprice,$dprice){
            return $fprice+($dprice['price']*$dprice['qty']);
        });
        return view('user.cart.cartlist',compact('cartList','totalprice'));
    }


    //order history
    public function Orderhistroy(){
        $orderData=Order::where('user_id',Auth::user()->id)->paginate('4');
        return view('user.main.history',compact('orderData'));
    }
}
