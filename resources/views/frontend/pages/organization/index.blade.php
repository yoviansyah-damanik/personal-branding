@extends('frontend.layouts.content')

@section('container')
    @include('frontend.sections.organizations')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(".organizations__slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                autoplay: false,
                focusOnSelect: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 1119,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                ],
                arrows: true,
                dots: false,
                prevArrow: $(".prev-organization-item"),
                nextArrow: $(".next-organization-item"),
                centerMode: false,
                centerPadding: "0px",
            });

        const itemsDown = [
            ".light4",
            ".light5",
            ".light6",
            ".light7",
            ".light8",
            ".light11",
            ".light12",
            ".light13",
            ".light14",
            ".light15",
            ".light16",
        ].forEach((e) => animateWithRandomNumber(e, -1080, 1080));
        const itemsUp = [
            ".light1",
            ".light2",
            ".light3",
            ".light9",
            ".light10",
            ".light17",
        ].forEach((e) => animateWithRandomNumber(e, 1080, -1080));

        function animateWithRandomNumber(myClass, from, to) {
            TweenLite.fromTo(
                myClass,
                Math.floor(Math.random() * 20 + 1), {
                    y: from
                }, {
                    y: to,
                    onComplete: animateWithRandomNumber,
                    onCompleteParams: [myClass, from, to],
                    ease: Linear.easeNone,
                }
            );
        }
    </script>
@endpush
