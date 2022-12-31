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
                            <h2 class="title-1">Admin List</h2>
                            
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
                
                <form class="form-header mb-3" action="{{route('admin#list')}}" >
                    @csrf
                    <input class="au-input au-input--xl" type="text" name="search" value="{{request('search')}}" placeholder="Search admin " />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                @if (request('search'))
                <div class="bg-light rounded-pill d-inline positon-relative p-2">
                    <span class="m-2">search key: <span class="text-danger">{{request('search')}}</span></span>
                    <a href="{{route('admin#list')}}" class="px-1" >
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                  </div>
                @endif
                <div class="float-md-end float-center my-md-2">
                   <h4>
                    {{ request('search')? 'Search ':'Total '  }}data founds- ({{$admin->total()}})</h4>
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
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Mail</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                {{-- <th>date</th>
                                    <th>status</th>
                                    <th>price</th> --}}
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                <tr class="tr-shadow">
                               
                                    <td> 
                                        @if ($a->image==null)
                                            @if ($a->gender=='female')
                                            <a href="#">
                                                <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/pf.jpg')}}" alt="{{$a->name}}" />
                                            </a>
                                            @else
                                            <a href="#">
                                                <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/Default_user.png')}}" alt="{{$a->name}}" />
                                             </a>
                                            @endif
                                        @else
                                        <a href="#">
                                           <img class=" rounded-circle" width="85px" height="85px" src="{{asset('storage/'.$a->image)}}" alt="{{$a->name}}" />
                                        </a>
                                        @endif</td>
                                   
                                    <td class="desc">{{$a->name}}</td>
                                    <td class="desc">{{$a->email}}</td> 
                                    <td class="desc">{{$a->gender}}</td>
                                    <td class="desc">{{$a->phone}}</td>
                                    <td class="desc">{{$a->address}}</td>
                                    

                                    
                                    <td>
                                        @if (Auth::user()->id!=$a->id)
                                        <div class="dropdown ">
                                                    
                                            <button class="btn btn-light dropdown-toggle changeUser" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-user me-2 "></i>Admin
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item Changerole" href="#"  onclick="Changemodal({{$a->id}})">
                                                        <i class="fa-solid fa-user-shield me-2"></i>
                                                        User
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                            
                                            
                                            <dialog id="role-{{$a->id}}" class="m-auto border-0 shadow" >
                                                
                                                
                                                <div class="p-4">
                                                    <div class="modal-body">
                                                        <h4 class="mb-3">Are you sure to Change <span class="text-primary" >{{$a->name}}</span> to User</h4>
                                                        
                                                    </div>
                                                    <div class="modal-footer ">
                                                        
                                                        <form method="dialog">
                                                            <button class="btn btn-sm btn-secondary m-1">Close</button>
                                                        </form>
                                                        
                                                        <input  class="userId" type="text" value="{{$a->id}}" hidden>
                                                        <a href="#"  class="m-1 btn btn-sm btn-success changeAdmin">
                                                            Change User
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                
                                            </dialog>
                                            
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            
                                           @if (Auth::user()->id!=$a->id)
                                           <button type="submit" onclick="modal({{$a->id}})" class="item" data-toggle="tooltip" data-placement="top" title="delete"">
                                                <a href="#" >
                                                    <i class="zmdi zmdi-delete text-damger me-1"></i>

                                                </a>
                                            </button> 
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Role">
                                                <a href="{{route('admin#rolePage',$a->id)}}">
                                                    <i class="fa-solid fa-user-shield me-1"></i>

                                                </a>
                                            </button> 
                                           @endif
                                            
                                            <dialog id="dia-{{$a->id}}" class="m-auto border-0 shadow">
                                

                                                <div class="p-4">
                                                    <div class="modal-body">
                                                        <h4 class="mb-3">Are you sure to Delete <span class="text-danger " >{{$a->name}}</span>'s account </h4>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="dialog">
                                                            <button class="btn btn-sm btn-secondary m-1">Close</button>
                                                        </form>
                                                        <a href="{{route('admin#delete',$a->id)}}" class="m-1 btn btn-sm btn-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>

                                               
                                            </dialog>
                                            
                                        </div>
                                    </td>
                        
                                    
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                                
                        
                                
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{$categories->links()}} --}}
                            {{$admin->appends(request()->query())->links()}}
                        </div>
                    </div>
                 
                </div>
                
            </div>
        </div>
    </div>
</div>

    @endsection
    @section('scriptSource')
        
    <script> 
        
        $(document).ready(function () {
            
            $('.changeAdmin').click(function(){
                $parentNode=$(this).parents('td');
                $userId=$parentNode.find('.userId').val();
                $role=$parentNode.find('.Changerole').text().toLowerCase();
                $parentNode.find('.changeUser').html('<i class="fa-solid fa-user me-2"></i> User');
                console.log($role);
                $('#role-'+$userId).hide(); 
                $.ajax({
                    type:'get',
                    url :'/admin/ajax/user/RoleChange/',
                    dataType:'json',
                    data:{
                        'user_id':$userId,
                        'status':$role
                    },
                    
                    
                    
                })
                location.reload();
            })
            
            
            
        })
        
        
    </script>
    @endsection