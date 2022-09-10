@extends('admin.layouts.app')

@section('title', 'Cập nhật thông tin')

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
                    <h1 class="m-0">Cập nhật thông tin sản phẩm</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @include('admin.layouts.alert')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật sản phẩm</h3>
                </div>
                <form action="{{ route('products.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Nhập vào tên danh mục">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="menu_id">Danh mục:</label>
                                    <select class="form-control" name="menu_id" id="menu_id">
                                        <option value="">-Chọn danh mục-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="price">Giá gốc:</label>
                                    <input type="number" class="form-control" name="price" id="price">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="price_sale">Giá giảm:</label>
                                    <input type="number" class="form-control" name="price_sale" id="price_sale">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="thumb">Hình ảnh:</label>
                            <input type="file" class="form-control" name="thumb" id="thumb">
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
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Huỷ bỏ</a>
                    </div>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                </form>

            </div>
        </div>
    </section>
@endsection
