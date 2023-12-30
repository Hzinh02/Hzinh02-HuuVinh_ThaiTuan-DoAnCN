@extends('welcome')
@section('showorderdetail')

<h1 style="text-align: center;">Đơn hàng</h1>
<br></br>
<table class=table mt-3>
    <thead>
        <tr>
            <th style="color: black" scope="col">Tên sản phẩm</th>
            <th style="color: black" scope="col">Giá/1</th>
            <th style="color: black" scope="col">Số lượng</th>
            <th style="color: black" scope="col">Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        @php $tongtien=0 @endphp
        @foreach($orderdetail as $i)
        @php $tongtien+=$i->subtotal @endphp
        <tr>
            <td style="color: black">{{$i->drink_name}}</td>
            <td style="color: black">{{number_format($i->price)}} VND</td>
            <td style="color: black">{{$i->quantity}}</td>
            <td style="color: black">{{number_format($i->subtotal)}} VND</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;">
                <h3><strong>Tổng tiền: {{number_format($tongtien)}} VND</strong></h3>
                <a href="{{route('listorder')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Xem đơn hàng</a>
            </td>
        </tr>
    </tfoot>
</table>

@endsection