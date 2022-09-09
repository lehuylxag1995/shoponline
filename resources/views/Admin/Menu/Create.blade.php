@extends('admin.layouts.app')

@section('title', 'Tạo menu cho website')

@section('head')
    @parent
    <!-- CKEditor 4. -->
    <script src="/admin/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tạo mới menu cho website</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @include('admin.layouts.alert')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm danh mục</h3>
                </div>
                <form action="/menu/store" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên danh mục:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Nhập vào tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Danh mục phụ thuộc:</label>
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="0">-Chọn danh mục-</option>
                                @foreach ($listParentMenu as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả:</label>
                            <textarea placeholder="Nhập mô tả ngắn gọn" class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Mô tả chi tiết:</label>
                            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                        <a href="/dashboard" class="btn btn-danger">Huỷ bỏ</a>
                    </div>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                </form>

            </div>
        </div>
    </section>
@endsection
