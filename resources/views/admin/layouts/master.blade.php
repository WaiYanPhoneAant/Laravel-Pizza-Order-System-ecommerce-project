<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- custom css --}}
    <link href="{{asset('custom/style.css')}}" rel="stylesheet">

</head>


<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{route('dashboard')}}" class="text-decoration-none">
                    {{-- <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" /> --}}
                    <h1 class="d-inline"><span class="text-danger">Pizza</span> hub</h1> 
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('category#list')}}">
                                <i class="fas fa-chart-bar"></i>Category List
                            </a>
                        </li>

                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('products#list')}}">
                                <i class="fa-solid fa-pizza-slice"></i>Products
                            </a>
                        </li>
                        
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('Order#list')}}">
                                <i class="fa-regular fa-rectangle-list"></i>Order Lists
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('customer#list')}}">
                                <i class="fa-solid fa-users me-3"></i>Customer Lists
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('mails#List')}}">
                                <i class="fa-solid fa-envelope-open-text me-3"></i>Mails list
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->


        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <h3 class="form-header">Admin Dashboard Pannel</h3>
                                {{-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> --}}
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image==null)
                                                    @if (Auth::user()->gender=='female')
                                                    <a href="#">
                                                        <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/pf.jpg')}}" alt="{{Auth::user()->name}}" />
                                                    </a>
                                                    @else
                                                    <a href="#">
                                                        <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/Default_user.png')}}" alt="{{Auth::user()->name}}" />
                                                    </a>
                                                    @endif
                                            @else
                                            <a href="{{route('admin#details')}}">
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}" />
                                            </a>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="{{route('admin#details')}}">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                @if (Auth::user()->image==null)
                                                    @if (Auth::user()->gender=='female')
                                                        <a href="#">
                                                            <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/pf.jpg')}}" alt="{{Auth::user()->name}}" />
                                                        </a>
                                                        @else
                                                        <a href="#">
                                                            <img class=" rounded-circle" width="85px" height="85px" src="{{asset('image/Default_user.png')}}" alt="{{Auth::user()->name}}" />
                                                        </a>
                                                    @endif
                                                    @else
                                                    <a href="{{route('admin#details')}}">
                                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                                    </a>
                                                @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="{{route('admin#details')}}">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#details')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#list')}}">
                                                        <i class="fa-solid fa-users"></i>Admin list</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#changePasswordPage')}}">
                                                        <i class="fa-solid fa-key"></i>change password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer my-3">
                                                
                                                <form action="{{route('logout')}}" class="d-flex justify-content-center" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger col-10" type="submit">
                                                        <i class="fa-solid fa-right-from-bracket p-1"></i>Logout
                                                    </button>
                                                </form>
                                                

                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            
        <!-- MAIN CONTENT-->
            @yield('content')

            <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
        </div>
    </div>








<!-- Jquery JS-->
<script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<!-- {asset(admin/Vendor JS       -->
<script src="{{asset('admin/vendor/slick/slick.min.js')}}">
</script>
<script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
</script>
<script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
</script>
<script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('admin/vendor/select2/select2.min.js')}}">
</script>

<!-- Main JS-->
<script src="{{asset('admin/js/main.js')}}"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

{{-- {-- jquery --}} 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('scriptSource')
{{-- custom js --}}
<script src="{{asset('custom/dialog.js')}}"></script>
</body>

</html>
<!-- end document-->