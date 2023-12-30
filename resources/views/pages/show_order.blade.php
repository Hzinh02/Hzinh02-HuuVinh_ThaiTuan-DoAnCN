@extends('welcome')
@section('showorder')

<h1 style="text-align: center;">Đơn hàng</h1>
<br></br>
<table class=table mt-3>
    <thead>
        <tr>
            <th style="color: black" scope="col">Tên</th>
            <th style="color: black" scope="col">Địa chỉ</th>
            <th style="color: black" scope="col">Số Điện thoại</th>
            <th style="color: black" scope="col">Trạng thái</th>
            <th style="color: black" scope="col">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $i)
        <tr>
            <td style="color: black">{{$i->name}}</td>
            <td style="color: black">{{$i->address}}</td>
            <td style="color: black">{{$i->phone}}</td>
            <td style="color: black">
                @if($i->status == 0)
                <div style="color:red; font-weight: bold;">Chờ xác nhận</div>
                @endif
                @if($i->status==1)
                <div style="color:blue; font-weight: bold;">Đã xác nhận</div>
                @endif
                @if($i->status !=0 && $i->status !=1)
                <div style="color:black; font-weight: bold;">Đang giao</div>
                @endif
            </td>
            <td>
                @if($i->status==0)
                <a class="btn btn-danger" href="{{ route('order.delete', ['id' => $i->id_order]) }}">Hủy đơn</a>
                @endif
                <a class="btn btn-success" href="{{route('order.detail',['id' => $i->id_order])}}">Xem chi tiết</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection