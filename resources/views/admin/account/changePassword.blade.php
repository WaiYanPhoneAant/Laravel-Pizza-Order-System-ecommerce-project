@extends('admin.layouts.master')


@section('content')
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row">
                  <div class="col-3 offset-8">
                     <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">Category List</button></a>
                  </div>
            </div>
            <div class="col-lg-6 offset-3">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-title">
                              <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>

                        @if (session('pwChangeSuccess'))
                        <div class="col-12">
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{session('pwChangeSuccess')}}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        @if (session('notMatch'))
                        <div class="col-12">
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{session('notMatch')}}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                           @csrf
                             
                                 
                           
                              <div class="form-group mb-4">
                                 <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                 <input id="cc-pament" name="oldpassword" type="password" value="{{old('oldpassword')}}" class="form-control  @if (session('notMatch')) is-invalid  @endif @error('oldpassword') is-invalid  @enderror "notMatchred="true" aria-invalid="false" placeholder="Enter old password">
                            
                                    
                                 @error('oldpassword')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                @enderror
                              </div>

                              <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="Newpassword" type="password" value="{{old('Newpassword')}}" class="form-control  @error('Newpassword') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Enter new Password">
                                @error('Newpassword')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                @enderror
                             </div>

                             <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-1">Comfrim password</label>
                                <input id="cc-pament" name="confrimPassword" type="password" value="{{old('confrimPassword')}}" class="form-control  @error('confrimPassword') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Enter comfrim password">
                                @error('confrimPassword')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                @enderror
                             </div>
                              
                              <div>
                                 <button id="payment-button" type="submit" class="btn  btn-info btn-block mt-3 w-100">
                                    <span id="payment-button-amount">Change Password</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    
                                 </button>
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