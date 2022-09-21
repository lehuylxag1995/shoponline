@extends('guest.layouts.app')

@section('title', 'Trang chủ')

<!-- Slider -->
@include('guest.home.slider')

<!-- Banner -->
@include('guest.home.banner')

@section('content')
    <div class="p-b-10">
        <h3 class="ltext-103 cl5">
            Sản Phẩm
        </h3>
    </div>

    <div id="LoadProduct">
        @include('guest.home.product')
    </div>

    <!-- Load more -->
    <div id="divLoadMore" class="flex-c-m flex-w w-full p-t-45">
        <a id="btnLoadMore" data-page="2" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
            Xem Thêm
        </a>
    </div>
@endsection
