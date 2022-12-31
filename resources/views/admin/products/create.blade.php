@extends('admin.layouts.master')


@section('content')
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row">
                  <div class="col-3 offset-8">
                     <a href="{{route('products#list')}}"><button class="btn bg-dark text-white my-3">Category List</button></a>
                  </div>
            </div>
            <div class="col-lg-6 offset-3">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-title">
                              <h3 class="text-center title-2">Create <span class="text-danger">Product</span></h3>
                        </div>
                        <hr>
                        <form action="{{route('products#create')}}" enctype="multipart/form-data" method="POST" novalidate="novalidate">
                           @csrf
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Name</label>
                                 <input id="cc-pament" name="name" type="text" value="{{old('name')}}" class="form-control  @error('name') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Product Name...">
                                 @error('name')
                                     <div class="invalid-feedback">
                                       {{$message}}
                                     </div>
                                 @enderror
                              </div>

                              <div class="row">
                                 <div class="form-group mt-2 col-6">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="price" type="number" value="{{old('price')}}" class="form-control  @error('price') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Price...">
                                    @error('price')
                                        <span class="text-danger">
                                          {{$message}}
                                        </span>
                                    @enderror
                                 </div>
                                 <div class="col-6 mt-2">
                                    <label for="cc-payment" class="control-label mb-1">Waiting time(Minutes)</label>
                                    <input id="cc-pament" name="waiting_time" type="number" value="{{old('waiting_time')}}" class="form-control  @error('waiting_time') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Waiting time...">
                                    @error('waiting_time')
                                        <span class="text-danger">
                                          {{$message}}
                                        </span>
                                    @enderror
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="category_id" id="" class="form-control @error('category_id') is-invalid  @enderror" >
                                       <option value=" ">Choose Your Pizza categories</option>
                                       @foreach ($categories as $category)
                                           
                                           <option value="{{$category->id}}" @if (old('gender')==$category->id) selected @endif>{{$category->name}}</option>
                                       @endforeach
                                   </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                          {{$message}}
                                        </div>
                                    @enderror
                              </div>

                              <div class="form-group mt-2">
                                 <label for="cc-payment" class="control-label mb-1">Image</label>
                                 <input id="cc-pament" name="image" type="file" class="form-control  @error('image') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Pizza...">
                                 @error('image')
                                     <div class="invalid-feedback">
                                       {{$message}}
                                     </div>
                                 @enderror
                              </div>

                              <div class="form-group mt-2">
                                 <label for="cc-payment" class="control-label mb-1">Description</label>
                                 <textarea name="description" id="" class="form-control @error('description') is-invalid  @enderror"  cols="30" rows="10">{{old('description')}}</textarea>
                                 @error('description')
                                     <div class="invalid-feedback">
                                       {{$message}}
                                     </div>
                                 @enderror
                              </div>

                              <div class="col-12">
                                 <button id="payment-button" type="submit" class="btn  btn-info btn-block mt-3 col-12">
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