@extends('welcome')
@if (count((array) session('cart'))!=0)
@section('content-cart')
<table id="cart" class="table table-bordered">
    <thead>
        <th style="text-align: center; margin: 0 auto; padding:20px">Nước uống</th>
        <th style="text-align: center; margin: 0 auto; padding:20px">Giá</th>
        <th style="text-align: center; margin: 0 auto; padding:20px">Số lượng</th>
        <th style="text-align: center; margin: 0 auto; padding:20px">Tổng</th>
        <th style="text-align: center; margin: 0 auto; padding:20px">Thao Tác</th>
    </thead>
    <tbody>
        @php $total= 0 @endphp
        @if(session('cart'))
        @foreach(session('cart') as $id => $cartdetails )
        @php $total+=$cartdetails['price']*$cartdetails['quantity'] @endphp


        <tr rowId="{{$id}}">
            <td data-th="Drink">
                <div class="row">
                    <div class="col-sm-3 hidden-xs" style="text-align: center; margin: 0 auto; padding:20px"><img src="{{asset('backend/images')}}/{{$cartdetails['image']}}" class="cart-img-top" alt="" style="width:10rem;"></div>
                    <div class="col-sm-9" style="text-align: center; margin: 0 auto; padding:20px">
                        <h4 class="nomargin">{{$cartdetails['name']}}</h4>
                    </div>
                </div>
            </td>
            <td data-th="Price" style="text-align: center; margin: 0 auto; padding:20px">{{ number_format($cartdetails['price'])}} VND</td>
            <td>
                <div style="text-align:center; padding:20px">
                    <form action="{{route('update.cart', $id)}}" class="d-flex">
                        <button type="submit" value="down" name="change_to" class="btn btn-danger">
                            @if($cartdetails['quantity'] ==1) x @else - @endif
                        </button>
                        <input type="number" value="{{$cartdetails['quantity']}}" disabled style=" width:50px">
                        <button type="submit" value="up" name="change_to" class="btn btn-success">
                            +
                        </button>
                    </form>
                </div>
            </td>
            <td>
                <div style="text-align: center; margin: 0 auto; padding:20px">{{number_format($cartdetails['price'] * $cartdetails['quantity'])}} VND</div>
            </td>
            <td class="actions" style="text-align:center;">
                <a style="font-size: 25px; text-align:center; color:red;" href="" class="btn btn-outline-danger btn-sm delete-drink"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach
        <h4 style="text-align: center;"><a href="{{route('listorder')}}"><i class="fa fa-shopping-cart"></i>Xem đơn hàng<span class="badge bg-danger">{{$countorder}}</span></a></h4>
        @endif
    </tbody>
</table>
<table id="thahhtoan" class="table table-bordered">
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;">
                <h3><strong>Tổng tiền: {{number_format($total)}} VND</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right;">
                <div id="wrapper" style="display:flex;justify-content: center; align-items: center;">
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800" style="text-align: center;">Điền thông tin đơn hàng</h1>

                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('order.add') }}">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <input placeholder="Tên người nhận" type="text" class="form-control form-control-sm" style="width: 500px;" id="name_user" name="name_user" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input placeholder="Địa chỉ người nhận" type="text" class="form-control form-control-sm" style="width: 500px;" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <input placeholder="Số điện thoại" type="text" class="form-control form-control-sm" style="width: 500px;" id="phone" name="phone" required>
                                </div>
                                <div>
                                    <br></br>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-money"></i>Đặt hàng</button>
                            </form>
                        </div>

                    </div>
                </div>
                <a href="{{route('trangindex')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Tiếp tục mua</a>
            </td>
        </tr>
    </tfoot>
</table>

@endsection
@else
@section('cartnull')
<div>
    <tr style="text-align: center;">
        <td>
            <h1 style="text-align: center; color:red ">Chưa có sản phẩm trong giỏ hàng!</h1>
        </td>
    </tr>
    <tr>
        <td>
            <h4 style="text-align: center;"><a href=" {{route('trangindex')}}" class="btn btn-success">Xem sản phẩm</a></h4>
        </td>
    </tr>
    <tr>
        <td>
            <h4 style="text-align: center;"><a href="{{route('listorder')}}"><i class="fa fa-shopping-cart"></i>Xem đơn hàng<span class="badge bg-danger">{{$countorder}}</span></a></h4>
        </td>
    </tr>

</div>

@endsection
@endif

@section('scripts')
<script type="text/javascript">
    $(".delete-drink").click(function(e) {
        e.preventDefault();
        var ele = $(this);

        if (confirm("Bạn có chắc muốn xóa?")) {
            $.ajax({
                url: '{{route("delete_cart")}}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowID")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection