<!DOCTYPE html>
<html lang="en-US">

@include('frontend.partials.content.header')

<body data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="0">
    @include('sweetalert::alert')

    {{-- header start  --}}
    @include('frontend.partials.content.navbar')
    {{-- #header end  --}}

    {{-- main section start  --}}
    <main class="main">

        @yield('container')

    </main>
    {{-- #main section end  --}}

    @include('frontend.partials.preloader')

    @include('frontend.partials.content.footer')
    @include('frontend.partials.social-media')
    @include('frontend.partials.content.js')
</body>

</html>
