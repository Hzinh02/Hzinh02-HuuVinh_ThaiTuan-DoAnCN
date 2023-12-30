@extends('welcome')
@section('test')

<body>
    <table class=table mt-3>
        <thead>
            <tr>
                <th scope="col" style="color: black">ID</th>
                <th scope="col" style="color: black">Name</th>
                <th scope="col" style="color: black">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sortDrink as $i)
            <tr>
                <td style="color: black">{{$i->drink_id}}</td>
                <td style="color: black">{{$i->drink_name}}</td>
                <td>
                    <a href="{{ route('cat.delete', ['id' => $i->cat_id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                    <a href="{{ route('cat.edit',['id' => $i->cat_id]) }}" class="btn btn-primary">Sửa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
@endsection