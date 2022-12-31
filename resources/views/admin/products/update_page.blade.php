@extends('admin.layouts.master')


@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 offset-9">
                    <a href="{{route('products#list')}}"><button class="btn bg-dark text-white my-3">Product list</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="#" onclick="history.back()" class="fs-4"><i class="text-dark fa-regular fa-circle-left"></i></a>
                            <h3 class="offset-5 d-inline title-2 "><i class="fa-solid fa-gear me-2 text-danger"></i>Edit</h3>
                        </div>
                        <hr>
                        @if (session('success'))
                            <div class="col-12 ">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <form action="{{route('products#update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6 text-center">
                                    
                                    <a href="#">
                                        <img class="my-4" width="300px" height="300px"  src="{{asset('storage/'.$product->image)}}" alt="" />
                                    </a>
                                    
                                    
                                    
                                    <div class="form-group col-9 m-auto ">
                                        <input type="file" class="form-control @error('image') is-invalid  @enderror" name="image" id="file" value="{{$product->image}}">
                                        @error('image')
                                        <div class="text-start text-danger">
                                            *{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="my-3">
                                        <button type="submit" class="btn btn-secondary col-9 m-auto">
                                            <i class="fa-solid fa-cloud m-2"></i>Update
                                        </button>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    
                                    <h3 class="text-muted my-3">Edit pizza detail <span class="btn btn-sm btn-success"><i class="fa-solid fa-eye me-1"></i>viewer ( {{$product->view_count}} )</span></h3>
                                    
                                    
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name',$product->name)}}" class="form-control  @error('name') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Pizza...">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group mt-2 col-6">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="number" value="{{old('price',$product->price)}}" class="form-control  @error('price') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Price...">
                                            @error('price')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mt-2">
                                            <label for="cc-payment" class="control-label mb-1">Waiting time(*min)</label>
                                            <input id="cc-pament" name="waiting_time" type="number" value="{{old('waiting_time',$product->waiting_time)}}" class="form-control  @error('waiting_time') is-invalid  @enderror " aria-required="true" aria-invalid="false" placeholder="Waiting time...">
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
                                            <option value=" ">Choose Your Pizza</option>
                                            @foreach ($categories as $category)
                                            
                                            <option value="{{$category->id}}" @if ($product->category_id==$category->id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group mt-2">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="description" id="" class="form-control @error('description') is-invalid  @enderror"  cols="30" rows="10">{{old('description',$product->description)}}</textarea>
                                        @error('description')
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