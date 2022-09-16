@extends('admin.layouts.app')

@section('title', 'Tạo ảnh quảng cáo cho website')

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
                    <h1 class="m-0">Tạo mới ảnh quảng cáo cho website</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @include('admin.layouts.alert')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm ảnh quảng cáo</h3>
                </div>
                <form action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên ảnh quảng cáo:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Nhập vào tên ảnh quảng cáo" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input value="{{ old('url') }}" type="text" class="form-control" name="url"
                                id="url" placeholder="Nhập vào đường dẫn website liên kết, vd: lehuy.com.vn">
                        </div>
                        <div class="form-group">
                            <label for="thumb">Hình ảnh:</label>
                            <input type="file" class="form-control" name="thumb" id="thumb">
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
