@extends('admin.layouts.master')


@section('content')
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         
         <div class="col-lg-10 offset-1">
            <div class="card">
               <div class="card-header">
                  <div class="col-12">
                     <a href="#"  onclick="history.back()" class="btn btn-secondary">
                        <i class="fa-sharp fa-solid fa-arrow-left me-1"></i>                        
                        back
                     </a>
                  </div>
               </div>
               <div class="card-body">
                  
                  
                  <form action="{{route('admin#update')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        
                        <div class="offset-1 col-4">
                           <div class="text-center mb-2">
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
                                 <img class=" rounded-circle" width="250px" height="250px" src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                              </a>
                              @endif
                           </div>
                           
                           
                           <div class="form-group my-4 ">
                              <input type="file" class="form-control" name="image" id="" value="{{Auth::user()->image}}">
                              @error('image')
                              <div class="text-danger">
                                 *{{$message}}
                              </div>
                              @enderror
                           </div>
                           <div class="my-3">
                              <button type="submit" class="btn btn-secondary col-12">
                                 <i class="fa-solid fa-cloud m-2"></i>Update
                              </button>
                              
                           </div> 
                        </div>
                        <div class="col-6 offset-1">
                           <h3 class="text-muted my-3">Account Profile</h3>
                           
                           
                           <div class="form-group mb-4">
                              <label for="cc-payment" class="control-label mb-1">User Name</label>
                              <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control  @if (session('notMatch')) is-invalid  @endif @error('name') is-invalid  @enderror "notMatchred="true" aria-invalid="false" placeholder="Enter your Name">
                              
                              
                              @error('name')
                              <div class="invalid-feedback">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           
                           <div class="form-group mb-4">
                              <label for="cc-payment" class="control-label mb-1">Email</label>
                              <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}" class="form-control  @if (session('notMatch')) is-invalid  @endif @error('email') is-invalid  @enderror "notMatchred="true" aria-invalid="false" placeholder="Enter your email>
                              
                              
                              @error('email')
                              <div class="invalid-feedback">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           
                           <div class="form-group mb-4">
                              <label for="cc-payment" class="control-label mb-1">Phone</label>
                              <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}}" class="form-control  @if (session('notMatch')) is-invalid  @endif @error('phone') is-invalid  @enderror "notMatchred="true" aria-invalid="false" placeholder="Enter old phone">
                              
                              
                              @error('phone')
                              <div class="invalid-feedback">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           
                           <div class="form-group mb-4">
                              <label for="cc-payment" class="control-label mb-1">role</label>
                              <input id="cc-pament" type="text" value="{{old('role',Auth::user()->role)}}" disabled class="form-control  @if (session('notMatch')) is-invalid  @endif @error('role') is-invalid  @enderror "notMatchred="true" aria-invalid="false" placeholder="Enter role">
                              
                              
                              @error('role')
                              <div class="invalid-feedback">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Gender</label>
                              <select name="gender" id="" class="form-control">
                                 <option value="male" {{Auth::user()->gender=='male'?'selected':'';}}>Male</option>
                                 <option value="female" {{Auth::user()->gender=='female'?'selected':'';}}>Female</option>
                              </select>
                              @error('gender')
                              <small class="text-danger">{{$message}}</small>
                              @enderror            
                           </div>
                           <div class="form-group mb-4">
                              <label for="cc-payment" class="control-label mb-1">Address</label>
                              <textarea name="address" id="" class="form-control @error('address') is-invalid  @enderror" cols="30" rows="10">{{old('address',Auth::user()->address)}}</textarea>
                              
                              
                              @error('address')
                              <div class="invalid-feedback">
                                 {{$message}}
                              </div>
                              @enderror
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