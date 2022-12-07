<!DOCTYPE html>
<html lang="en-US">

@include('frontend.partials.header')

<body data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="0">

    {{-- header start  --}}
    @include('frontend.partials.navbar')
    {{-- #header end  --}}

    {{-- main section start  --}}
    <main class="main">

        @yield('container')

    </main>
    {{-- #main section end  --}}

    @include('frontend.partials.preloader')

    @include('frontend.partials.js')
</body>

</html>
