<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="admin/templatev1/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        @include('admin.layouts.navbar')

        @include('admin.layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin.layouts.footer')

    </div>

    @include('admin.layouts.script')
</body>

</html>
