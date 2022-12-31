@extends('admin.layouts.master')

@section('title','category list')
@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            
            
            
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Customer Mails List</h2>
                            
                        </div>
                    </div>
                    
                </div>
                
                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('updateSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                
                <form class="form-header mb-3" action="{{route('mails#List')}}" >
                    @csrf
                    <input class="au-input au-input--xl" type="text" name="search" value="{{request('search')}}" placeholder="Search Users" />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                @if (request('search'))
                <div class="bg-light rounded-pill d-inline positon-relative p-2">
                    <span class="m-2">search key: <span class="text-danger">{{request('search')}}</span></span>
                    <a href="{{route('mails#List')}}" class="px-1" >
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
                @endif
                <div class="float-md-end float-center my-md-2">
                    <h4>
                        {{ request('search')? 'Search ':'Total '  }}data founds- ({{$mailDatas->total()}})</h4>
                    </div>
                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    
                    
                    <div class="table-responsive table-responsive-data2">
                        @if (count($mailDatas)!=0)
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mail</th>
                                    <th>Message</th>
                                </tr>  
                            </thead>
                                
                                <tbody>
                                    @foreach ($mailDatas as $md)
                                    <tr class="tr-shadow">
                                        
                                       
                                            
                                            <td class="desc text-dark">{{$md->name}}</td>
                                            <td class="desc text-dark">{{$md->email}}</td> 
                                            
                                            
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a  type="button" class="text-primary text-decoration-underline" data-bs-toggle="modal" data-bs-target="{{'#md-'.$md->id}}">
                                                    {{substr($md->message,0,50)}}
                                                </a>

                                            </td>
                                            
                                            
                                    </tr>
                                    <tr class="spacer"></tr>
                                         

                                        @endforeach
                                        
                                        
                                        
                                </tbody>
                                </table>
                               
                                    
                                    
                               
                                <div class="mt-3">
                                    {{-- {{$categories->links()}} --}}
                                    {{$mailDatas->appends(request()->query())->links()}}
                                </div>
                                @else
                                  
                                      
                                    <div class="m-auto mt-5 text-center">
                                       
                                        There is no user here
                                                
                                    </div>
                                      
                                    
                                @endif  
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
          {{-- modal box section --}}
          @foreach ($mailDatas as $md)
          <div class="modal fade" id="md-{{$md->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Message from <span class="text-primary">{{$md->name}}</span></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{$md->message}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Close</button> --}}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @endsection
