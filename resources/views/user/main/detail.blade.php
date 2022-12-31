@extends('user.layouts.master')

@section('content')
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="col-md-6 offset-1">
        <a onclick="history.back()" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-3"></i>back</a>
    </div>
</div>
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide text-center" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-75 h-75" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-75 h-75" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-75 h-75" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-75 h-75" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>
        <input type="hidden" name="pizza_id" id="pizza_id" value="{{$pizza->id}}">
        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$pizza->name}}</h3>
                <div class="d-flex mb-3">
                    <span class="btn btn-sm btn-warning my-2 rounded"><i class="fa-solid fa-eye me-2"></i>{{$pizza->view_count}} </span>  
                </div>
                <h3 class="font-weight-semi-bold mb-4">${{$pizza->price}}</h3>
                <p class="mb-4">{{$pizza->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="{{isset($cart->qty)?$cart->qty:1}}" id="orderCount">
                        
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $product)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden m-auto" style="width: 200px;height:200px;">
                            <img class="img-fluid w-100 h-100 m-auto" src="{{asset('storage/'.$product->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('pizza#detail',$product->id)}}"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$product->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${{$product->price/2}}</h5><h6 class="text-muted ml-2"><del>${{$product->price}}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->
@endsection
@section('scriptSource')
<script>
    $(document).ready(function () {
        $id=$('#pizza_id').val();
        $.ajax({
                    type:'get',
                    url :'/user/ajax/product/viewCount/',
                    data:{'product_id':$id},
                    dataType:'json',
  
                    })
             })    
      
        


        $('#addCartBtn').click(function () {
            if($('#orderCount').val()!=0){
                $source={
                    'pizza_id':$('#pizza_id').val(),
                    'count':$('#orderCount').val(),
                };
                $.ajax({
                    type:'get',
                    url :'/user/ajax/AddtoCart',
                    data:$source,
                    dataType:'json',
                    success : function (response) {
                        if(response.status=='success'){
                            window.location.href="/user/home";
                        }
                        
                        
                    }
                })    
            }
            
            
        })
    
</script>
@endsection


