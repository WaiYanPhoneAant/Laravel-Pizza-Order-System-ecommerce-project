@extends('admin.layouts.master')

@section('title','category list')
@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            
            
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>
                            
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('products#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Pizza
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
            
                @if (session('Deletesuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                       Success <span class="text-danger">Delete</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('Success'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{session('Success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{session('updateSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('pwChangeSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{session('pwChangeSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                
                <form class="form-header mb-3" action="{{route('products#list')}}" >
                    @csrf
                    <input class="au-input au-input--xl" type="text" name="search" value="{{request('search')}}" placeholder="Search categories" />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                @if (request('search'))
                <div class="bg-light rounded-pill d-inline positon-relative p-2">
                    <span class="m-2">search key: <span class="text-danger">{{request('search')}}</span></span>
                    <a href="{{route('products#list')}}" class="px-1" >
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                  </div>
                @endif
                <div class="float-md-end float-center my-md-2">
                   <h4>
                    {{ request('search')? 'Search ':'Total '  }}data founds- ({{$products->total()}})</h4>
                </div>
                @if (count($products)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Pizza Name</th>
                                <th>Price </th>
                                <th>View Count </th>
                                <th>Category </th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="tr-shadow">
                                    <td><img src="{{asset('storage/'.$product->image)}}"  width="130px" height="130px" alt=""></td>
                                    <td class="desc">{{$product->name}}</td>
                                    <td>{{$product->price}} $</td>
                                    <td><i class="fa-solid fa-eye m-1"></i>{{$product->view_count}}</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View details">
                                                <a href="{{route('products#detail',$product->id)}}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <a href="{{route('products#updatePage',$product->id)}}">
                                                <i class="zmdi zmdi-edit"></i>
                                                </a>
                                            </button>
                                          
                                            <button type="submit" onclick="modal({{$product->id}})" class="item" data-toggle="tooltip" data-placement="top" title="Edit"">
                                                <a href="#" onclick="modal({{$product->id}})">
                                                    <i class="zmdi zmdi-delete text-damger"></i>
                                                    
                                                </a>    
                                            </button> 
                                            
                                            <dialog id="dia-{{$product->id}}" class="m-auto border-0 shadow ">
                                                <div class="p-4">
                                                    <div class="modal-body">
                                                        <h4 class="mb-2">Are you sure to Delete <span class="text-danger " >{{$product->name}}</span>'s account </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="dialog">
                                                            <button class="btn btn-sm btn-secondary m-1">Close</button>
                                                        </form>
                                                        <a href="{{route('products#delete',$product->id)}}" class="m-1 btn btn-sm btn-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                
                                            </dialog>
                                           
                                            
   
                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$products->appends(request()->query())->links()}}
                        </div>
                    </div>
                    @else
                    <span class="text-center mt-5 d-block">There is no pizza</span>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
                
            </div>
        </div>
    </div>
</div>

    @endsection
    