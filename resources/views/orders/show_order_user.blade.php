@extends('admin_layout')
@section('showorderuser')

<h1>Quản lý danh mục</h1>
@if(session('success'))
<div class="alert alert-success" style="text-align: center;">
    {{session('success')}}
</div>
@endif
<table class=table mt-3>
    <thead>
        <tr>
            <th style="color: black" scope="col">Mã đơn hàng</th>
            <th style="color: black" scope="col">Tên người đặt</th>
            <th style="color: black" scope="col">Địa chỉ giao</th>
            <th style="color: black" scope="col">Số điện thoại</th>
            <th style="color: black" scope="col">Tài khoản người mua</th>
            <th style="color: black" scope="col">Trạng thái đơn hàng</th>
            <th style="color: black" scope="col">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $i)
        <tr>
            <td style="color: black">{{$i->id_order}}</td>
            <td style="color: black">{{$i->name}}</td>
            <td style="color: black">{{$i->address}}</td>
            <td style="color: black">{{$i->phone}}</td>
            <td style="color: black">{{$i->email_user}}</td>
            <td style="color: black">
                @if($i->status==0)
                Chờ xác nhận
                @endif
                @if($i->status==1)
                Đã xác nhận
                @endif
                @if($i->status==2)
                Đang giao hàng
                @endif
            </td>
            <td>
                @if($i->status==0)
                <button class="btn btn-success"><a style="color:aliceblue" href="{{route('order.confirm',['id' => $i->id_order])}}">Xác nhận</a></button>
                @endif
                @if($i->status==1 || $i->status==2)
                <button class="btn btn-danger"><a style="color:aliceblue" href="{{route('order.unconfirm',['id' => $i->id_order])}}">Hủy Xác nhận</a></button>
                @endif
                @if($i->status!=2 && $i->status!=0)
                <button class="btn btn-success"><a style="color:aliceblue" href="{{route('order.delivery',['id' => $i->id_order])}}">Xác nhận giao hàng</a></button>
                @endif

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection