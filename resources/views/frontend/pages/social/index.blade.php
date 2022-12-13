@extends('frontend.layouts.content')

@section('container')
    @include('frontend.sections.socials')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(".socials__slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                autoplay: true,
                focusOnSelect: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                prevArrow: $(".prev-social-item"),
                nextArrow: $(".next-social-item"),
                centerMode: true,
                centerPadding: "0px",
            });
    </script>
@endpush
