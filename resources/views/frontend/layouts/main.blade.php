<!DOCTYPE html>
<html lang="en-US">

@include('frontend.partials.main.header')

<body data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="0">
    @include('sweetalert::alert')

    {{-- header start  --}}
    @include('frontend.partials.main.navbar')
    {{-- #header end  --}}

    {{-- main section start  --}}
    <main class="main">

        @yield('container')

    </main>
    {{-- #main section end  --}}

    @include('frontend.partials.preloader')

    @include('frontend.partials.social-media')
    @include('frontend.partials.main.js')
</body>

</html>
