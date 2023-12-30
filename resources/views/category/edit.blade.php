@extends('admin_layout')
@section('edit')
<div id="wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm Loại Sản Phẩm</h1>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('cat.update', ['id' => $category->cat_id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="cat_id" class="form-label">ID Catgory :</label>
                    <input type="text" class="form-control" style="width: 500px;" id="cat_id" name="cat_id" value="{{ $category->cat_id }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="cat_name" class="form-label">Tên Loại Sản Phẩm:</label>
                    <input type="text" class="form-control" style="width: 500px;" id="cat_name" name="cat_name" value="{{ $category->cat_name }}">
                </div>
                <div>
                    <br></br>
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection