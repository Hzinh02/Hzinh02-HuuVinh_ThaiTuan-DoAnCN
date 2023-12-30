@extends('admin_layout')
@section('edititem')
<div id="wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sửa Sản Phẩm</h1>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('drink.update', ['id' => $drink->drink_id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class=" mb-3">
                    <div class="mb-3">
                        <label for="drink_id" class="form-label">ID Sản Phẩm:</label>
                        <input type="text" class="form-control form-control-sm" style="width: 500px;" id="drink_id" name="drink_id " value="{{ $drink->drink_id }}" required readonly>
                    </div>

                </div>
                <div class="mb-3">
                    <label for="drink_name" class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control form-control-sm" style="width: 500px;" id="drink_name" name="drink_name" value="{{ $drink->drink_name}}" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="text" class="form-control form-control-sm" style="width: 500px;" id="price" name="price" value="{{ $drink->price }}" required>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">IMG:</label>
                    <img src="/backend/images/{{$drink->img}}" style="width:5rem;" alt="ảnh">
                    <input type="file" class="" style="width: 500px;" id="file" name="img" required>
                </div>
                <div class="mb-3">
                    <label for="cat_id" class="form-label">Loại Sản Phẩm:</label>
                    <select name="cat_id" class="form-control form-control-sm" style="width: 500px;">
                        @foreach($category as $i)
                        <!-- <option value="{{ $i->cat_id }}" selected>$i->cat_name>{{ $i->cat_name }}</option> -->
                        <option value="{{ $i->cat_id }}" {{ $i->cat_id == $drink->cat_id ? 'selected' : '' }}>{{ $i->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div>
            <br></br>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Cập Nhật</button>
        </form>
    </div>
    @endsection