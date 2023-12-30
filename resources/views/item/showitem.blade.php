@extends('admin_layout')
@section('showitem')

<h1>Quản lý danh mục</h1>
@if(session('success'))
<div class="alert alert-success" style="text-align: center;">
    {{session('success')}}
</div>
@endif
<table class=table mt-3>
    <thead>
        <tr>
            <th style="color: black" scope="col">ID</th>
            <th style="color: black" scope="col">Name</th>
            <th style="color: black" scope="col">Price</th>
            <th style="color: black" scope="col">IMG</th>
            <th style="color: black" scope="col">Catgory Name</th>
            <th style="color: black" scope="col">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drink as $i)
        <tr>
            <td style="color: black">{{$i->drink_id}}</td>
            <td style="color: black">{{$i->drink_name}}</td>
            <td style="color: black">{{$i->price}}</td>
            <td style="color: black"><img src="{{asset('backend/images')}}/{{$i->img}}" style="width:3rem;" alt="ảnh"></td>
            <td style="color: black">{{$i->cat_name}}</td>
            <td>
                <a href="{{ route('drink.delete', ['id' => $i->drink_id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                <a href="{{ route('drink.edit', ['id' => $i->drink_id]) }}" class="btn btn-primary">Sửa</a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection