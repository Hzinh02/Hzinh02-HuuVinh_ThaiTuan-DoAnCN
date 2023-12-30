<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | CoffeShop</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{('frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('frontend/images/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('frontend/images/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('frontend/images/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('frontend/images/apple-touch-icon-57-precomposed.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
</head>

<body>
    <header id=" header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="{{route('trangindex')}}"><i class="fa fa-phone"></i> +84 99 99 99 999</a></li>
                                <li><a href="{{route('trangindex')}}"><i class="fa fa-envelope"></i>mail@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/highlandscoffeevietnam"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/home"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/')}}"><img src="{{asset('frontend/images/logo.png')}}" alt="" style="height: 150px; width:150px;" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a><i class="fa fa-user"></i>
                                        @if(Auth::user() && Auth::user()->is_admin==0)
                                        Hello, {{ Auth::user()->name }}
                                        @else
                                        Bạn chưa đăng nhập
                                        @endif
                                    </a></li>
                                <li><a href="{{route('shopping.cart')}}"><i class="fa fa-shopping-cart"></i>Giỏ hàng<span class="badge bg-danger">
                                            @if(Auth::check()==null || Auth::user()->is_admin!=0)
                                            0
                                            @else
                                            {{count((array) session('cart'))}}
                                            @endif
                                        </span></a></li>
                                @if(Auth::check() && Auth::user()->is_admin==0)
                                <li><a href="{{route('logoutuser')}}"><i class="fa fa-lock"></i>Đăng xuất</a></li>
                                @else
                                <li><a action="{{ route('register')}}" href="{{URL::to('/register_login')}}"><i class="fa fa-lock"></i>Đăng nhập/Đăng ký</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        @yield('header_bottom')
    </header><!--/header-->
    @if(session('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{session('success')}}
    </div>
    @endif

    @if(session('status'))
    <div class="alert alert-danger" style="text-align: center;">
        {{session('status')}}
    </div>
    @endif

    @if(session('status1'))
    <div class="alert alert-danger" style="text-align: center;">
        {{session('status1')}}
    </div>
    @endif

    <section>
        <div class="container">
            @yield('content')
            @yield('content-cart')
            @yield('cartnull')
            @yield('showorder')
            @yield('showorderdetail')
            @yield('filter')
            @yield('test')
            @yield('detail')
        </div>
    </section>


    @yield('scripts')
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>