@extends('admin.layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách sản phẩm</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @include('admin.layouts.alert')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Mã SP</th>
                                        <th>Tên SP</th>
                                        <th>Danh Mục</th>
                                        <th>Giá(VNĐ)</th>
                                        <th>Giá giảm(VNĐ)</th>
                                        <th>Hình ảnh</th>
                                        <th>Trạng thái</th>
                                        <th colspan="2" class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($listProduct as $p)
                                        <tr>
                                            <td><b>{{ $p->id }}</b></td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->menu->name }}</td>
                                            <td>{{ number_format($p->price) }}</td>
                                            <td>{{ number_format($p->price_sale) }}</td>

                                            <td>
                                                @if ($p->thumb)
                                                    <img src="{{ url($p->thumb) }}" alt="{{ $p->name }}" width="100px"
                                                        height="100px">
                                                @else
                                                    <p>Chưa có hình</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($p->active)
                                                    <button class="btn btn-success">Active</button>
                                                @else
                                                    <button class="btn btn-danger">No Active</button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-md"
                                                    href="{{ route('products.edit', ['product' => $p]) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('products.destroy', ['product' => $p]) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-md">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <h3>Chưa có dữ liệu nào...</h3>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
@endsection
