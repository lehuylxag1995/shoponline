<div class="row isotope-grid">
    @foreach ($ListProduct as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ url($product->thumb) }}" alt="IMG-PRODUCT">

                    <a href="/san-pham/{{ $product->slug }}.html"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Xem chi tiết
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/san-pham/{{ $product->slug }}.html"
                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->name }}
                        </a>

                        <span class="stext-105 cl3">
                            {{ number_format($product->price) ?? 'Liên Hệ' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
