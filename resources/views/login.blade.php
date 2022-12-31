@extends('layouts.master')

@section('title','category list')
@section('content')
<div class="login-form">
    <form action="{{route('login')}}" method="post">
        @csrf
        <small class="text-danger"> <x-jet-validation-errors class="mb-4" /></small>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password" value="{{old('password')}}">
        </div>
        
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
        
    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
                        
               