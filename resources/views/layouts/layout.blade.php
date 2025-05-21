<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merdeka Belajar Kampus Merdeka</title>



    <link rel="shortcut icon" href="{{ asset('logo_kampus.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/assets/compiled/css/iconly.css') }}">
    @yield('style')
</head>

<body>
    <script src="{{ asset('/dist/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('components.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('section')

            @include('components.copyright')

        </div>
    </div>

    <script src="{{ asset('/dist/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/dist/assets/compiled/js/app.js') }}"></script>
    @vite('resources/js/currentdate.js')
    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
