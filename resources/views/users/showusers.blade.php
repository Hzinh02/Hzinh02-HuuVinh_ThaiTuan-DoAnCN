@extends('admin_layout')
@section('showusers')

<h1>Quản lý danh mục</h1>
@if(session('success'))
<div class="alert alert-success" style="text-align: center;">
    {{session('success')}}
</div>
@endif
<table class=table mt-3>
    <thead>
        <tr>
            <th style="color: black" scope="col">Email</th>
            <th style="color: black" scope="col">Password</th>
            <th style="color: black" scope="col">Name</th>
            <th style="color: black" scope="col">Role</th>
            <th style="color: black" scope="col">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $i)
        <tr>
            <td style="color: black">{{$i->email}}</td>
            <td style="color: black">{{$i->password}}</td>
            <td style="color: black">{{$i->name}}</td>
            <td style="color: black">{{$i->is_admin}}</td>
            <td>
                @if($i->is_admin==0)
                <a class="btn btn-danger" href="{{ route('user.delete', ['email' => $i->email]) }}">Xóa</a>
                @endif
                @if($i->is_admin==0 && Auth::user()->email=='admin@admin.com')
                <a class="btn btn-success" href="{{route('users.setroleadmin',['email' => $i->email])}}">Set Role Admin</a>
                @endif
                @if($i->is_admin==1 && $i->email!=Auth::user()->email && $i->email!='admin@admin.com')
                @if(Auth::user()->email=='admin@admin.com')
                <a class="btn btn-danger" href="{{route('users.unsetroleadmin',['email' => $i->email])}}">Hủy Admin</a>
                @endif
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection