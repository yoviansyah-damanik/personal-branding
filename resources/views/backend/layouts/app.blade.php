<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; {{ $_app_name }}</title>

    <link rel="stylesheet" href="{{ asset('backend-assets/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ $_app_favicon ?? asset('branding-images/favicon.png') }}" type="image/x-icon">

    @stack('style')
    @livewireStyles

    <link rel="stylesheet" href="{{ asset('backend-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/css/components.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('backend.components.header')

            <!-- Sidebar -->
            @include('backend.components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('backend.components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('backend-assets/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('backend-assets/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('backend-assets/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backend-assets/js/stisla.js') }}"></script>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('backend-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('backend-assets/js/custom.js') }}"></script>
</body>

</html>
