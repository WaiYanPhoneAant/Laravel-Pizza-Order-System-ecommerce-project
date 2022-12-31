@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="col-md-12 text-center text-decoration-underline">
   <h3> Contact Form</h3>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-6 table-responsive mb-5 mt-5">
           
            <form action="{{route('contact#send')}}" method="POST">
                @csrf
                
                <div class="form-group m-3">
                    <label for="" class="form-label">Enter Your Name</label>
                    <input type="text" name="name" id="" class="form-control @error('name') is-invalid  @enderror" placeholder="enter your name" value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                            {{'*'.$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group m-3">
                    <label for="" class="form-label">Enter Your Email</label>
                    <input type="email" name="email" id="" class="form-control @error('email') is-invalid  @enderror" placeholder="Enter Your Mail" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{'*'.$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group m-3">
                    <label for="" class="form-label">Enter Your Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message') is-invalid  @enderror" placeholder="Your message" value="{{old('message')}}"></textarea>
                    <span class="text-danger">
                        @error('message')
                            {{'*'.$message}}
                        @enderror
                    </span>
                </div>
                <button type="submit" class="btn btn-warning m-3 rounded  float-end">
                    <i class="fa-regular fa-paper-plane me-2"></i> Send
                </button>
            </form>
        </div>
        <div class="col-lg-6 mt-5">
      
            <h5 class=" text-decoration-underline text-black-50 d-block">Our Address</h5>
           
            
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.2200165122867!2d78.38168290487266!3d17.449180436261454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb91fe277879eb%3A0xde63e22515c934f5!2spizzahub!5e0!3m2!1smy!2smm!4v1669643394756!5m2!1smy!2smm" width="100%" height="40%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            
            <h5 class="mt-3"> Contact Us</h5>
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-2">
                        <i class="fa-regular fa-envelope me-3"></i> Email : admin@gmail.com
                    </div>
                    <div class="m-2">
                        <i class="fa-solid fa-phone me-3"></i> Phone : 09123456789
                    </div>
                    <div class="m-2">
                        <i class="fa-regular fa-map me-3"></i> Address : Silicon Valley,
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Cart End -->

@endsection
@section('scriptSource')

@endsection