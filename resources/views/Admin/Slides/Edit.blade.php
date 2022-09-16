@extends('admin.layouts.app')

@section('title', 'Cập nhật ảnh quảng cáo cho website')

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
                    <h1 class="m-0">Cập nhật ảnh quảng cáo cho website</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @include('admin.layouts.alert')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật ảnh quảng cáo</h3>
                </div>
                <form action="{{ route('slide.update', ['slide' => $slide]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên ảnh quảng cáo:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Nhập vào tên ảnh quảng cáo" value="{{ $slide->name }}">
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input value="{{ $slide->url }}" type="text" class="form-control" name="url"
                                id="url" placeholder="Nhập vào đường dẫn website liên kết, vd: lehuy.com.vn">
                        </div>
                        <div class="form-group">
                            <label for="sort_by">Cập nhật thứ tự hiển thị:</label>
                            <input value="{{ $slide->sort_by }}" type="number" class="form-control" name="sort_by"
                                id="sort_by">
                        </div>
                        <div class="form-group">
                            <label for="content">Trạng thái:</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="active1" value="1"
                                    name="active" {{ $slide->active == 1 ? 'checked' : '' }}>
                                <label for="active1" class="custom-control-label">Hiển thị trên website</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" value="0" id="active2"
                                    name="active" {{ $slide->active == 0 ? 'checked' : '' }}>
                                <label for="active2" class="custom-control-label">Không hiển thị trên website</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="thumb">Chọn hình khác:</label>
                                    <input type="file" class="form-control" name="thumb" id="thumb">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="avatar">Hình ảnh hiện tại:</label>
                                    <br>
                                    <img src="{{ url($slide->thumb) }}" alt="{{ $slide->name }}" width="300px"
                                        height="300px">
                                </div>
                            </div>
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
