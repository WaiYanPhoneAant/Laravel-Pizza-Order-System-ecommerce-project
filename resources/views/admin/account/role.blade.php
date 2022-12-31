@extends('admin.layouts.master')


@section('content')
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         
         <div class="col-lg-10 offset-1">
            <div class="card">
               <div class="card-header">
                  <div class="col-12">
                     <a href="{{route('admin#list')}}" class="btn btn-secondary">
                        <i class="fa-sharp fa-solid fa-arrow-left me-1"></i>                        
                        back
                     </a>
                  </div>
               </div>
               <div class="card-body">
                  
                  
                  <form action="{{route('admin#roleupdate',$admin->id)}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        
                        <div class="offset-1 col-5">
                           <div class="text-center mb-5">
                              @if ($admin->image==null)
                                 @if ($admin->gender=='female')
                                 <a href="#">
                                    <img class=" rounded-circle" width="250px" height="250px" src="{{asset('image/pf.jpg')}}" alt="{{$admin->name}}" />
                                 </a>
                                 @else
                                 <a href="#">
                                    <img class=" rounded-circle" width="250px" height="250px" src="{{asset('image/Default_user.png')}}" alt="{{$admin->name}}" />
                                 </a>
                                 @endif
                              @else
                              <a href="#">
                                 <img class=" rounded-circle" width="250px" height="250px" src="{{asset('storage/'.$admin->image)}}" alt="John Doe" />
                              </a>
                              @endif
                           </div>
                           
                           <div class="mt-3">
                              <h4 class="my-3"><i class="fa-solid fa-user-pen me-2"></i> {{$admin->name}}</h4>
                              <h4 class="my-3"><i class="fa-regular fa-envelope me-2"></i> {{$admin->email}}</h4>
                              <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i> {{$admin->phone}}</h4>
                              <h4 class="my-3"><i class="fa-solid fa-location-dot me-2"></i> {{$admin->address}}</h4>
                              <h4 class="my-3"><i class="fa-solid fa-person-half-dress me-3"></i>{{$admin->gender}}</h4>
                              <h4 class="my-3"><i class="fa-regular fa-calendar me-2"></i>{{$admin->created_at->format('j-F-Y')}}</h4>
                           </div>
            
                           
                        </div>
                        <div class="col-5 ">
                           <h4 class="text-muted my-3">Role Change</h4><hr>

                           
                           <select name="role" id="" class="form-control">
                              <option value="admin" @if($admin->role=='admin') selected @endif >Admin</option>
                              <option value="user" @if($admin->role=='user') selected @endif >User</option>
                           </select>
                           
                           
                           <div class="my-3">
                              <button type="submit" class="btn btn-secondary col-12">
                                 <i class="fa-solid fa-right-left m-2"></i>Change Role
                              </button>                             
                           </div>                          
                        </div>
                        
                        
                     </div>
                     
                  </form>
               </div>
            </div>
         </div> 
      </div>
   </div>
</div>
@endsection
</body>
</html>