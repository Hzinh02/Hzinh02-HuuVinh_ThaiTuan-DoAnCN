@extends('admin_layout')
@section('additem')
<div id="wrapper">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm Sản Phẩm</h1>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('drink.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="drink_id" class="form-label">ID Sản Phẩm:</label>
                        <input type="text" class="form-control form-control-sm" style="width: 500px;" id="drink_id" name="drink_id">
                    </div>

                </div>
                <div class="mb-3">
                    <label for="drink_name" class="form-label">Tên Sản Phẩm:</label>
                    <input type="text" class="form-control form-control-sm" style="width: 500px;" id="drink_name" name="drink_name" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="text" class="form-control form-control-sm" style="width: 500px;" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">IMG:</label>
                    <input type="file" class="" style="width: 500px;" id="img" name="img" required>
                </div>
                <div class="mb-3">
                    <label for="cat_id" class="form-label">Loại Sản Phẩm:</label>
                    <select name="cat_id" class="form-control form-control-sm" style="width: 500px;">
                        @foreach($category as $i)
                        <option value="{{ $i->cat_id }}">{{ $i->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <br></br>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Thêm</button>
            </form>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection