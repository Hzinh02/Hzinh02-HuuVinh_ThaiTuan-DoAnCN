@extends('welcome')
@section('detail')

@foreach($drink as $i)
<div>
    <div class="col-sm-5">
        <img src="{{asset('backend/images')}}/{{$i->img}}" style="width:40rem;" alt="ảnh">
    </div>
    <div class="col-sm-7">
        <div><i style="font-size: 40px; color:red;">Tên: {{$i->drink_name}}</i></div>
        <div><i style="font-size: 20px;">Giá: {{$i->price}}</i></div>
        <br></br>
        <div><a href="{{route('addtocart',$i->drink_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a></div>
    </div>
</div>
@endforeach

@endsection