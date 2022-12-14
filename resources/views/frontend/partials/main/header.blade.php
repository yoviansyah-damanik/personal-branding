<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- META --}}
    <meta name="keywords" content="{{ isset($_add_keyword) ? $_add_keyword . ',' . $_keywords : $_keywords }}" />
    <meta name="description" content="{{ $_description ?? $_app_description }}" />
    <meta name="og:site_name" content="{{ $_app_name }}">
    <meta property="og:title" content="{{ isset($_title) ? $_title . ' | ' . $_app_name : $_app_name }}">
    <meta property="og:description" content="{{ $_description ?? $_app_description }}">
    <meta property="og:image"
        content="{{ isset($_image) ? asset($_image) : $_app_ads ?? asset('branding-images/ads.png') }}">
    <meta property="og:url" content="{{ $_url ?? url()->current() }}">
    <meta property="og:type" content="{{ $_type ?? 'website' }}">
    <meta name="author" content="{{ $_author ?? $_app_name }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ $_favicon ?? asset('branding-images/favicon.png') }}" type="image/x-icon">
    <title>{{ isset($_title) ? $_title . ' | ' . $_app_name : $_app_name }}</title>

    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/magnific-popup/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/slick/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/fullpage/css/jquery.fullpage.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/vendor/aos/css/aos.c') }}ss">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/custom.css') }}" />

    @livewireStyles
</head>
