@extends('admin_layout')
@section('add')
<div id="wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm Danh Mục</h1>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('cat.add') }}">
                @csrf
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="cat_id" class="form-label">Mã danh mục:</label>
                        <input type="text" class="form-control form-control-sm" style="width: 500px;" id="cat_id" name="cat_id">
                    </div>

                </div>
                <div class="mb-3">
                    <label for="cat_name" class="form-label">Tên Danh Mục:</label>
                    <input type="text" class="form-control form-control-sm" style="width: 500px;" id="cat_name" name="cat_name" required>
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