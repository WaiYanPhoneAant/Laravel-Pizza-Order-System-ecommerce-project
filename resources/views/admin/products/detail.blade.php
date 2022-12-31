@extends('admin.layouts.master')


@section('content')
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row">
                  <div class="col-3 offset-9">
                     <a href="{{route('products#list')}}"><button class="btn bg-dark text-white my-3">Product list</button></a>
                  </div>
            </div>
            <div class="col-lg-10 offset-1">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-title">
                              <a href="#" onclick="history.back()" class="fs-4"><i class="text-dark fa-regular fa-circle-left"></i></a>
                              <h3 class="offset-5 d-inline title-2 ">Pizza Detail</h3>
                        </div>
                        <hr>
                       <div class="row">
                           <div class="col-6 text-center">                                  
                              <a href="#">
                                 <img class="" width="300px" height="300px"  src="{{asset('storage/'.$product->image)}}" alt="" />
                              </a>
                           </div>
                           
                            <div class="col-6">
                                 @if (session('success'))
                                 <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                       {{session('success')}}
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                 </div>
                                 @endif
                                 <span class="btn btn-sm btn-info my-2 "><i class="fa-solid fs-5 fa-pizza-slice me-2"></i> {{$product->name}}</span><br>
                                 <span class="btn btn-sm btn-success my-2 "><i class="fa-solid fs-5 fa-money-bill me-2"></i> {{$product->price}} $</span> 
                                 <span class="btn btn-sm btn-danger my-2 "><i class="fa-solid fa-eye me-2"></i>{{$product->view_count}} </span>  
                                 <span class="btn btn-sm btn-primary my-2 "><i class="fa-regular fa-clone"></i> {{$product->category_name}}</span>     
                                 <span class="btn btn-sm btn-warning my-2 "><i class="fa-solid fs-5 fa-clock-rotate-left me-2"></i> {{$product->waiting_time}} min</span>
                                 <span class="btn btn-sm btn-secondary my-2 "><i class="fa-regular fs-5 fa-calendar  me-2"></i>{{$product->created_at->format('j-F-Y | h:i A')}}</span>
                                 <div class=" my-2 "><i class="fa-regular fa-file-lines"></i>
                                       <span class="text-dark text-underline">Description </span><br>
                                    <p class="m-1"> {{$product->description}}</p>
                                 </div>
                                
                                
                           </div>                            
                        </div>
                     </div>
                  </div>
            </div> 
         </div>
      </div>
   </div>
@endsection
</body>
</html>