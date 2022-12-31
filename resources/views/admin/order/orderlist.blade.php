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
                            <h2 class="title-1">Order List</h2>
                            
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
                
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Success <span class="text-danger">Delete</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                
                @if (session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('createSuccess')}}
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
                
                <form class="form-header mb-3" action="{{route('Order#list')}}" >
                    @csrf
                    <input class="au-input au-input--xl" type="text" name="search" value="{{request('search')}}" placeholder="Search Order Code" />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                @if (request('search'))
                <input type="hidden" name="searh" class="search" value="{{request('search')}}">
                <div class="bg-light rounded-pill d-inline positon-relative p-2 mb-5">
                    <span class="m-2">search key: <span class="text-danger">{{request('search')}}</span></span>
                    <a href="{{route('Order#list')}}" class="px-1" >
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
                @endif
                <div class="filter col-3 mt-3">
                    <label for="filterStatus mb-1">Filter Order Status</label>
                    <select name="filter" id="filterStatus" class="form-select">
                        <option value="all" selected>All</option>
                        <option value="0">Pending Status</option>
                        <option value="1">Confirmed Status</option>
                        <option value="2">Cancled Status</option>
                    </select>
                </div>
                <div class="float-lg-end float-center my-md-2">
                    <h4>
                        {{ request('search')? 'Search ':'Total '  }}order founded- ({{count($orders)}})</h4>
                    </div>
                    @if (count($orders)!=0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="data">
                                
                                @foreach ($orders as $order)
                                <tr class="tr-shadow">
                                    {{-- id --}}
                                    <td>{{$order->user_id}}</td>
                                    {{-- order Name --}}
                                    <td class="desc">{{$order->user_name}}</td>
                                    
                                    {{-- created at --}}
                                    <td>{{$order->created_at->format('j-F-Y | h:i A')}}</td>
                                    
                                    {{-- button --}}
                                    <td><a href="{{route('order#Info',$order->order_code)}}">{{$order->order_code}}</a></td>
                                    <td>{{$order->total_price}} $</td>
                                    <td>
                                        {{-- <select name="" id="" class="form-select">
                                            <option value="0" {{$order->status==0 ? 'selected' :''}}> Pending</option>
                                            <option value="1" {{$order->status==1 ? 'selected' :''}}>Confirmed</option>
                                            <option value="2" {{$order->status==2 ? 'selected' :''}}> Denied</option>
                                        </select> --}}
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle statusText-{{$order->order_code}}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                @if ($order->status==0)
                                                <span class="text-info"><i class="fa-solid fa-clock-rotate-left me-2"></i>pending</span>
                                                @elseif ($order->status==1)
                                                <span class="text-success"><i class="fa-solid fa-check me-3" ></i>Confirmed</span>
                                                @elseif ($order->status==2)
                                                <span class="text-danger" ><i class="fa-solid fa-triangle-exclamation me-3" ></i>Cancled</span>
                                                @endif
                                            </button>
                                            
                                            <ul class="dropdown-menu">
                                                <li class=" status">
                                                    <a class="dropdown-item" href="#"  onclick="status('{{$order->order_code}}-0')"> 
                                                        
                                                        <span class="text-info te" id="{{$order->order_code}}"><i class="fa-solid fa-clock-rotate-left me-2"></i>pending</span>
                                                        
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"  onclick="status('{{$order->order_code}}-1')">
                                                        
                                                        <span class="text-success te "  id="{{$order->order_code}}"><i class="fa-solid fa-check me-3"></i>Confrimed</span>
                                                        
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"  onclick="status('{{$order->order_code}}-2')">
                                                        
                                                        <span class="text-danger te"  id=" {{$order->order_code}}"><i class="fa-solid fa-triangle-exclamation me-3"></i>Cancled</span>
                                                        
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                                
                                
                                
                                
                            </tbody>
                        </table>
                        <div class="mt-3 page">
                            {{-- {{$orders->links()}} --}}
                            {{$orders->appends(request()->query())->links()}}
                        </div>
                    </div>
                    @else
                    <span class="text-center mt-5 d-block">There is no category data</span>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')

<script> 
    function status(Orderstatus) {
        const [order_code,status_code]=Orderstatus.split('-');
        console.log(order_code,'  '+status_code);
        
        
        $.ajax({
            type:'get',
            url :'/admin/ajax/order/statusUpdate',
            dataType:'json',
            data:{
                'order_code':order_code,
                'status':status_code
            },
            success : function (response) {
                
                
                
                
            }
        })
        if (status_code==0)$(`.statusText-${order_code}`).html('<span class="text-info"><i class="fa-solid fa-clock-rotate-left me-2"></i>pending</span>');
        if (status_code==1)$(`.statusText-${order_code}`).html('<span class="text-success"><i class="fa-solid fa-check me-3" ></i>Confirmed</span>');
        if (status_code==2)$(`.statusText-${order_code}`).html('<span class="text-danger" ><i class="fa-solid fa-triangle-exclamation me-3" ></i>Cancled</span>');
        
        
        
    } 
    $(document).ready(function () {
        
        $('#filterStatus').change(()=>{
            
            $.ajax({
                type:'get',
                url :'/admin/ajax/order/filterStatus',
                dataType:'json',
                data:{
                    'status':$('#filterStatus').val(),
                },
                success : function (response) {
                    
                    $list=``;
                    for (const order of response) {
                        // 21-November-2022 | 07:52 PM
                        $DBdate=new Date(order.created_at);
                        $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                        $hours= $DBdate.getHours()>12 ? $DBdate.getHours()-12:$DBdate.getHours();
                        $AmPm=$DBdate.getHours()>12?'PM':'AM';
                        $date=$DBdate.getDate()+'-'+$month[$DBdate.getMonth()]+'-'+$DBdate.getFullYear() +' | '+$hours+':' +$DBdate.getMinutes()+ $AmPm;
                        
                        $list+=`
                        <tr class='t-shadow'>
                            <td>${order.user_id}</td>
                            
                            <td class="desc">${order.user_name}</td>
                            
                            
                            <td>${$date}</td>
                            
                            
                            <td><a href="/order/orderInfo/${order.order_code}">${order.order_code}</a></td>
                            <td>${order.total_price}</td>
                            <td>
                                
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle  statusText-${order.order_code}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        ${order.status==0?'<span class="text-info"><i class="fa-solid fa-clock-rotate-left me-2"></i>pending</span>':''}
                                        ${order.status==1?'<span class="text-success"><i class="fa-solid fa-check me-3"></i>Confirmed</span>':''}
                                        ${order.status==2?' <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-3"></i>Cancled</span>':''}    
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#"   onclick="status('${order.order_code}-0')"> 
                                                
                                                <span class="text-info"  ><i class="fa-solid fa-clock-rotate-left me-2"></i>pending</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"   onclick="status('${order.order_code}-1')">
                                                
                                                <span class="text-success"><i class="fa-solid fa-check me-3"></i>Confrimed</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"   onclick="status('${order.order_code}-2')">
                                                
                                                <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-3"></i>Cancled</span>
                                                
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        `
                        
                    }
                    $('tbody').html($list);
                    
                }
            })
        })
        
        
        
    })
    
    
</script>
@endsection
