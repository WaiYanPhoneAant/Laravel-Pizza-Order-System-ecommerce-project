@extends('admin.layouts.master')


@section('content')
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row">
   
                  <div class="col-3 offset-3">
                     <a href="#"  onclick="history.back()" class="btn btn-secondary">
                        <i class="fa-sharp fa-solid fa-arrow-left me-1"></i>                        
                        back
                     </a>
                  </div>
            
                  <div class="col-4 offset-2">
                     <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">Category List</button></a>
                  </div>
                  
            </div>
            <div class="col-lg-6 offset-3">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-title">
                              <h3 class="text-center title-2">Edit Category</h3>
                        </div>
                        <hr>
                        <form action="{{route('category#update')}}" method="post" novalidate="novalidate">
                           @csrf
                              <div class="form-group">
                                <input type="hidden" name="category_id" value="{{$category->id}}">
                                 <label for="cc-payment" class="control-label mb-1" autofocus>Edit your category</label>
                                 <input id="cc-pament" name="categoryName" type="text" value="{{old('categoryName',$category->name)}}" class="form-control  @error('categoryName') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Edit category">
                                 @error('categoryName')
                                     <div class="invalid-feedback">
                                       {{$message}}
                                     </div>
                                 @enderror
                              </div>
                              
                              <div>
                                 <button id="payment-button" type="submit" class="btn  btn-info btn-block mt-3">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
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