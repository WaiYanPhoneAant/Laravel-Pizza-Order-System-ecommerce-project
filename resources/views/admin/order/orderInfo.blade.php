@extends('admin.layouts.master')

@section('title','orderInfo')
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
                            <a href="{{route('Order#list')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
                            
                        </div>
                    </div>
                    
                </div>         
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-header fs-5">
                        
                        <i class="fa-solid fa-user me-2"></i>Account Info
                        
                    </div>
                    <div class="card-body">
                       
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <h5 class="text-muted p-3"><span class="text-black-50">Name - </span>{{$orderInfo[0]->user_name}} </h5>
                                <h5 class="text-muted  p-3"><span  class="text-black-50">Email - </span>{{$orderInfo[0]->email}} </h5>
                                <h5 class="text-muted p-3"><span  class="text-black-50">Address - </span>{{$orderInfo[0]->address}} </h5>
                            </div>    
                            <div class="col-md-6">
                                <h5 class="text-muted  p-3"><span  class="text-black-50">Phone - </span>{{$orderInfo[0]->phone}}</h5>
                                <h5 class="text-muted p-3"><span class="text-black-50">OrderCode - </span>{{$orderInfo[0]->order_code}} </h5>
                                <h5 class="text-muted  p-3"><span class="text-black-50">OrderDate - </span>{{date_format(date_create($orderInfo[0]->ordered_date),"j-F-Y | h:i A")}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orderInfo as $info)
                            <tr class="tr-shadow">
                              
                                <td class="text-center">{{$info->product_id}}</td>
                                <td>
                                  
                                    <img src="{{asset('storage/'.$info->product_image)}}" alt="" width="80px" height="80px" class="rounded">
                                </td>
                                <td>
                                    {{$info->product_name}}
                                </td>
                                <td>
                                    {{$info->qty}}
                                </td>
                                <td>
                                    {{$info->total_price}}$
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                          
                            
                            
                            
                        </tbody>
                    </table>
                    
                </div>
        </div>
    </div>
</div>

@endsection
