<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    {{-- start css --}}
    @include('layouts.admin.css')
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        {{-- sidebar --}}
        @include('layouts.admin.sidebar')

        <div class="content">
            {{-- header/topbar --}}
            @include('layouts.admin.header')

            {{-- Main content --}}
            @yield('content')
            {{-- end main content --}}

            {{-- footer --}}
            @include('layouts.admin.footer')
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    {{-- START JS --}}
    @include('layouts.admin.js')

</body>

</html>
