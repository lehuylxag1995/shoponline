<!DOCTYPE html>
<html lang="en">

{{-- class="animsition" --}}

<body>
    <!-- Head -->
    @include('guest.layouts.head')

    <!-- Header -->
    @include('guest.layouts.header')

    <!-- Cart -->
    @include('guest.layouts.cart')

    @yield('slider')

    @yield('banner')

    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <!-- Product -->
            @yield('content')
        </div>
    </section>


    <!-- Footer -->
    @include('guest.layouts.Footer')

    @include('guest.layouts.script')

</body>

</html>
