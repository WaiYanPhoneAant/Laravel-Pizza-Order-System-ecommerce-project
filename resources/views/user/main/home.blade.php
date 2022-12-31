@extends('user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5> --}}
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control d-flex align-items-center justify-content-between p-2 mb-3 bg-dark">

                        <label class="m-0 text-white" for="price-all" role="button">All Categories</label>
                        <span class="badge text-black bg-primary" style="font-size: 15px;">{{count($categories)}}</span>
                    </div>
                    <a href="{{route('user#home')}}" class="text-dark text-decoration-none" id="all" onclick="filter('all')">
                        <div class="custom-control rem custom-checkbox d-flex align-items-center justify-content-between mb-3 py-2 cat-class bg-primary text-black">
                            @if (count($categories)==0)
                            <span class="text-center d-block">There is no category here</span>
                            @endif
                            <span  class="text-all" role="button" for="price-1">All</span>

                        </div>
                    </a>
                    @foreach ($categories as $category)
                    <div class="custom-control rem custom-checkbox d-flex align-items-center justify-content-between mb-3 py-2 cat-class" onclick="filter({{$category->id}})">
                          <span class="text-{{$category->id}}" role="button" for="price-1" id="{{$category->id}}">{{$category->name}}</span>
                        {{-- <span class="badge border font-weight-normal"></span> --}}
                    </div>
                    @endforeach

                </form>
            </div>

            <div class="">
                <a href="{{route('order#history')}}" class="btn btn btn-warning w-100">Order</a>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>

                            <a href={{route('cart#list')}} type="button" class="btn btn-primary position-relative rounded">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                  {{count($cart)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </a>
                              <a href={{route('order#history')}} type="button" class="ms-2 btn btn-dark position-relative rounded">
                                <i class="fa-solid fa-clock-rotate-left"></i>History
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-dark">
                                  {{count($order)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}

                                <select name="sorting" id="sortingOption" class="btn btn-sm btn-light dropdown-toggle">
                                    <option value="">Choose Option..</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc" selected>Descending</option>

                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <h5 class="category text-dark m-3 text-decoration-underline fs-5" id='category'></h5>

                <div class="row d-flex" id="datalist">
                    @if (count($pizzas)==0)
                        <span class="text-center d-block">There is no product here</span>
                    @endif
                    @foreach ($pizzas as $pizza )
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myform">
                            <div class="product-img position-relative overflow-hidden" >
                                <img class="" src="{{asset('storage/'.$pizza->image)}}" alt="" width="350px" height="300px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('pizza#detail',$pizza->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$pizza->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$pizza->price}} $</h5><h6 class="text-muted ml-2"><del>{{$pizza->price/2}}$</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="https://onecms-res.cloudinary.com/image/upload/s--sEfcyVTf--/c_crop%2Ch_717%2Cw_957%2Cx_153%2Cy_771/c_fill%2Cg_auto%2Ch_622%2Cw_830/f_auto%2Cq_auto/v1/mediacorp/cna/image/2022/04/01/final-2.jpeg?itok=urO6AS9r" alt="">
                            <!-- <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div> -->
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>20$/h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="https://danamic-media.danamic.org/danamic-production/2022/04/12003417/Chicken-Satay-Pizza-Top-1024x1024.jpg" alt="">
                            <!-- <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div> -->
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>20$/h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="https://d1sag4ddilekf6.azureedge.net/compressed_webp/items/SGITE20200407093514014750/detail/674be39ff1144d6e9f5db2211c92f067_1590056669449973127.webp" alt="">
                            <!-- <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div> -->
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>20$/h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="https://media-cdn.tripadvisor.com/media/photo-s/1a/62/fb/84/pizza-hut.jpg" alt="">
                            <!-- <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div> -->
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>20$/h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function () {
        // $.ajax({
            //     type:'get',
            //     url :'http://127.0.0.1:8000/user/ajax/pizzaList',
            //     dataType:'json',
            //     success : function (response) {
                //         console.log(response)
                //     }
                // })


                $('#sortingOption').change(function(){
                    $eventOption=$('#sortingOption').val();
                    if($eventOption=='desc'){
                        $.ajax({
                            type:'get',
                            url :'/user/ajax/pizzaList',
                            data:{'status':'desc'},
                            dataType:'json',
                            success : function (response) {

                                $list='';
                                $id=0;
                                for (const data of response) {

                                    $list+=`
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4" id="myform">
                                            <div class="product-img position-relative overflow-hidden" >
                                                <img class="" src="{{asset('storage/${data.image}')}}" alt="" width="350px" height="300px">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="products/detail/${data.id}"><i class="fa-solid fa-eye"></i></a>
                                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${data.name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${data.price}</h5><h6 class="text-muted ml-2"><del>${data.price/2}</del></h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `

                                }
                                $('#datalist').html($list);

                            }
                        })
                    }else if($eventOption=='asc'){
                        $.ajax({
                            type:'get',
                            url :'/user/ajax/pizzaList',
                            data:{'status':'asc'},
                            dataType:'json',
                            success : function (response) {
                                $list='';
                                for (const data of response) {
                                    console.log(data);
                                    $list+=`
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4" id="myform">
                                            <div class="product-img position-relative overflow-hidden" >
                                                <img class="" src="{{asset('storage/${data.image}')}}" alt="" width="350px" height="300px">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="products/detail/${data.id}"><i class="fa-solid fa-eye"></i></a>
                                                    {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${data.name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${data.price}</h5><h6 class="text-muted ml-2"><del>${data.price/2}</del></h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `
                                }
                                $('#datalist').html($list);
                            }
                        })
                    }

                })
            })


            function filter(id) {
                $('.rem').children().removeClass('text-black');
                $('.rem').removeClass('bg-primary');
                $(`#${id}`).addClass('text-black');
                $(`#${id}`).parent('.rem').addClass('bg-primary')
                if(id=='all') return;
                $category=$(`#${id}`).text();
                $.ajax({
                    type:'get',
                    url :'/user/ajax/pizzafilter',
                    data:{'id':id},
                    dataType:'json',
                    success : function (response) {
                        $list='';
                        if (Object.keys(response).length>0) {
                            for (const data of response) {

                                // console.log(id?:'#');
                                $list+=`
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myform">
                                        <div class="product-img position-relative overflow-hidden" >
                                            <img class="" src="{{asset('storage/${data.image}')}}" alt="" width="350px" height="300px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="products/detail/${data.id}"><i class="fa-solid fa-eye"></i></a>
                                                {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${data.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${data.price} $</h5><h6 class="text-muted ml-2"><del>${data.price/2}</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#datalist').html($list);

                        }else{
                            $list+='<h5 class="text-black-50 text-center">There is no product for this category</h5>';
                            $('#datalist').html($list);
                        }
                        $('#category').html($category);
                    }



                })
            }
        </script>
        @endsection

