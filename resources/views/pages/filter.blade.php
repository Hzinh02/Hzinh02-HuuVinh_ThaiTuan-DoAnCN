@extends('welcome')
@section('filter')
<div class="row">

    <div class="col-sm-12 padding-right">
        <div class="features_items"><!--features_items-->
            @php $id='' @endphp
            @foreach($a as $i)
            <h2 class="title text-center"> FEATURES Items</h2>
            @php $id = $i->cat_id @endphp
            @endforeach

            @if(session('errorlogin'))
            <h2>
                <div class="alert alert-danger" style="text-align: center;">
                    {{session('errorlogin')}}
                </div>
            </h2>
            @endif
            @foreach($drink as $i)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('backend/images')}}/{{$i->img}}" alt="" />
                            <h2>{{number_format($i->price)}} VND</h2>
                            <p>{{$i->drink_name}}</p>
                            <a href="{{route('addtocart',$i->drink_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                            <a href="{{route('detail',$i->drink_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{number_format($i->price)}} VND</h2>
                                <p>{{$i->drink_name}}</p>
                                <a href="{{route('addtocart',$i->drink_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                <a href="{{route('detail',$i->drink_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--features_items-->

    </div>
</div>
@endsection

@section('header_bottom')
<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{URL::to('/')}}" class="">Trang chủ</a></li>
                        <li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                @foreach($category as $i)
                                <li><a href="{{ route('drink.filter', ['x' => $i->cat_id]) }}">{{$i->cat_name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <div>
                            <form action="{{ route('drink.search') }}" method="get">
                                <input type="text" name="query" placeholder="Nhập tên sản phẩm hoặc giá ">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                        <li class="dropdown"><a href="#" style="color:black">Lọc theo giá<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="{{ route('sort.drinkascprice',['id' => $id]) }}">Tăng dần</a></li>
                                <li><a href="{{ route('sort.drinkdescprice',['id' => $id]) }}">Giảm dần</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" style="color:black">Lọc theo tên<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="{{ route('sort.drinkascname',['id' => $id]) }}">A->Z</a></li>
                                <li><a href="{{ route('sort.drinkdescname',['id' => $id]) }}">Z->A</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->
@endsection