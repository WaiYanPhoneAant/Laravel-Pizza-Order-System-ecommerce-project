@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="dataTable">
                    
                    @foreach ($cartList as $cl)
                    <tr class="productTablerow">
                        <td class="align-middle text-left">
                            <img src="{{asset('storage/'.$cl->image)}}" class="me-2 rounded" alt="" style="width: 50px;">
                            {{$cl->name}}
                            <input type="hidden" class="product_id" value="{{$cl->product_id}}">
                            <input type="hidden" class="user_id" value="{{$cl->user_id}}">
                            
                        </td>
                        <td class="align-middle"  id="price" >${{$cl->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn"">
                                    <button class="btn btn-sm btn-primary btn-minus"  id="d-{{$cl->id}}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center qty" id="qty" value="{{$cl->qty}}">
                                <div class="input-group-btn ">
                                    <button class="btn btn-sm btn-primary btn-plus " id="t-{{$cl->id}}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">${{$cl->price*$cl->qty}}</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-danger btn-remove "><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>
            <div class="no-cart">
                @if (count($cartList)==0)
                <h5 class="text-black-50 text-center mt-5 ">
                    There is no cart here!
                </h5>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subtotal">${{$totalprice}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium" id="shippingFees">$15</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="cashOutTotal">{{$totalprice+15}}</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="OrderBtn">Proceed To Checkout</button>
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearAllCartsBtn">Clear all carts</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Cart End -->

@endsection
@section('scriptSource')
<script>
    $(document).ready(function () {
        
        //$price update check
        $price_update=function () {
            $parentNode=$(this).parents("tr");
            $price=Number($parentNode.find('#price').text().replace('$',''));
            $qty=Number( $parentNode.find('#qty').val());
            $total=$price*$qty;
            $parentNode.find('#total').html('$'+$total);
            $id=$(this).attr('id').replace('t','d');
            if($qty==0){
                console.log($id);
                $('#'+$id).attr("disabled", true);
            }else{ 
                console.log($id);
                $('#'+$id).attr("disabled",false);
            }
            priceCheck();
            
        }
        
        //final price check 
        
        function priceCheck() {
            $totalPrice=0;
            $('#dataTable tr').each(function (index,row){
                $totalPrice+=Number($(row).find('#total').text().replace('$',''));
            })
            $('#subtotal').text('$'+$totalPrice);
            $shippingFees=Number($('#shippingFees').text().replace('$',''));
            $fianlPrice=$totalPrice+$shippingFees
            $('#cashOutTotal').text('$'+$fianlPrice);
            
        }
        $('.btn-plus').click($price_update);
        $('.btn-minus').click($price_update);
        $('.qty').change($price_update);
        
        $('.btn-remove').click(function () {
            $parentNode=$(this).parents("tr");
            $product_id=$parentNode.find('.product_id').val();
            
            // priceCheck();
            $.ajax({
                type:'get',
                url :'/user/ajax/ClearOneItemCart',
                data:{'product_id':$product_id },
                dataType:'json',
                success : function (response) {
                    if(response.status==true){
                        $products=$('.productTablerow').length;
                        if($products==0){
                            $('.no-cart').html(`
                            <h5 class="text-black-50 text-center mt-5 ">
                                There is no cart here!
                            </h5>
                            `);
                        }
                    }
                    
                    
                }
            });
            $parentNode.remove();
            priceCheck();
        })
        
        
        // proceed to check out
        $('#OrderBtn').click(()=>{
            $user_id=$('.user_id').val();
            $order_list=[];
            $random=Math.ceil(Math.random() *10000);
            $random_1=Math.ceil(Math.random() *6);
            $('#dataTable tr').each((index,row)=>{
                
                $order_list.push({
                    'user_id': $user_id,
                    'product_id' :$(row).find('.product_id').val(),
                    'total':$(row).find('#total').text().replace('$',''),
                    'qty' :$(row).find('.qty').val(),
                    'orderCode' : '00'+$user_id+'rc'+$random*$random_1
                });
                
            });
            
            
            $.ajax({
                type:'get',
                url :'/user/ajax/order',
                dataType:'json',
                data:Object.assign({},$order_list),
                success : function (response) {
                    if(response.status==true){
                        window.location.href="/user/home?success=true";
                    }
                    
                    
                }
            })
        });
        // proceed to check out
        $('#clearAllCartsBtn').click(()=>{
            $user_id=$('.user_id').val();
            $order_list=[];
            $random=Math.ceil(Math.random() *10000);
            $random_1=Math.ceil(Math.random() *6);
            $('#dataTable tr').each((index,row)=>{
                
                $order_list.push({
                    'user_id': $user_id,
                    'product_id' :$(row).find('.product_id').val(),
                    'total':$(row).find('#total').text().replace('$',''),
                    'qty' :$(row).find('.qty').val(),
                    'orderCode' : '00'+$user_id+'rc'+$random*$random_1
                });
                
            });
            
            
            $.ajax({
                type:'get',
                url :'/user/ajax/ClearAllCarts',
                dataType:'json',
                success : function (response) {
                    if(response.status==true){
                        window.location.href="/user/home?success=true";
                    }
                    
                    
                }
            })
        });
        
    })
    
    
    
    
    
</script>
@endsection