<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- start css --}}
    @include('layouts.admin.css')
</head>

<body>

    {{-- Floating WhatsApp Button --}}
    @include('layouts.admin.wa')

    {{-- Loader --}}
    @include('layouts.admin.loader')

    {{-- Sidebar --}}
    @include('layouts.admin.sidebar')

    {{-- Content Wrapper --}}
    <div class="content">

        {{-- Navbar --}}
        @include('layouts.admin.navbar')

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('layouts.admin.footer')

    </div> {{-- end .content --}}

    {{-- Start JS --}}
    @include('layouts.admin.js')

</body>
</html>
