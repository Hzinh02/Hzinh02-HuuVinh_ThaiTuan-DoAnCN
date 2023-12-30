@extends('admin_layout')
@section('show')

<h1>Quản lý danh mục</h1>
@if(session('success'))
<div class="alert alert-success" style="text-align: center;">
    {{session('success')}}
</div>
@endif


@if(session('errordelete'))
<div class="alert alert-danger" style="text-align: center;">
    {{session('errordelete')}}
</div>
@endif
<table class=table mt-3>
    <thead>
        <tr>
            <th scope="col" style="color: black">ID</th>
            <th scope="col" style="color: black">Name</th>
            <th scope="col" style="color: black">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category as $i)
        <tr>
            <td style="color: black">{{$i->cat_id}}</td>
            <td style="color: black">{{$i->cat_name}}</td>
            <td>
                <a href="{{ route('cat.delete', ['id' => $i->cat_id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                <a href="{{ route('cat.edit',['id' => $i->cat_id]) }}" class="btn btn-primary">Sửa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection