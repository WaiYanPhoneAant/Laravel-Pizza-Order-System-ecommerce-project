@extends('admin.layouts.master')


@section('content')
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row"> 
                  <div class="col-3 offset-1 my-3">
                     <a href="#"  onclick="history.back()" class="btn btn-secondary">
                        <i class="fa-sharp fa-solid fa-arrow-left me-1"></i>                        
                        back
                     </a>
                  </div>
            
                
            </div>
            <div class="col-lg-10 offset-1">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-title">
                              <h3 class="text-center title-2">Acount Info</h3>
                        </div>
                        <hr>

                       <div class="row">
                            <div class="col-6 text-center">
                                @if (Auth::user()->image==null)
                                    @if (Auth::user()->gender=='female')
                                    <a href="#">
                                          <img class=" rounded-circle" width="250px" height="250px" src="{{asset('image/pf.jpg')}}" alt="{{Auth::user()->name}}" />
                                    </a>
                                    @else
                                    <a href="#">
                                          <img class=" rounded-circle" width="250px" height="250px" src="{{asset('image/Default_user.png')}}" alt="{{Auth::user()->name}}" />
                                    </a>
                                    @endif
                                 @else
                                 <a href="#">
                                     <img class=" rounded-circle"  width="250px" height="250px" src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                 </a>
                                @endif


                                
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
                                <h4 class="my-3"><i class="fa-solid fa-user-pen me-2"></i> {{Auth::user()->name}}</h4>
                                <h4 class="my-3"><i class="fa-regular fa-envelope me-2"></i> {{Auth::user()->email}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i> {{Auth::user()->phone}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-location-dot me-2"></i> {{Auth::user()->address}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-person-half-dress me-3"></i>{{Auth::user()->gender}}</h4>
                                <h4 class="my-3"><i class="fa-regular fa-calendar me-2"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <a href="{{route('admin#edit')}}" class="d-inline">
                                            <button class="btn bg-dark text-white">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                   
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