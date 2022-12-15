<section class="section hero" id="one">
    <div class="section__inner">
        <img src="{{ asset('frontend-assets/images/asset.jpg') }}" alt="Image" class="anim max-width-unset" />
        <div class="section__inner-content" data-background="{{ asset('frontend-assets/images/profile.png') }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="hero__content" data-aos="fade-right">
                            {{-- <a class="hero__popup" href="https://www.youtube.com/watch?v=K8ixLPaenM8" target="_blank"
                                title="YouTube video player">
                                <i class="fa-solid fa-play"></i>
                            </a> --}}
                            <h5 class="hero__subtitle">{{ __("Hi, I'm An Optimist!") }}</h5>
                            <h2 class="hero__title"><span class="typed">Developer</span></h2>
                            <p class="hero__text">Kota Padang Sidempuan, Sumatera Utara, Indonesia.</p>
                            <div class="hero__cta">
                                <a href="#experience" data-menuanchor="experience" class="cmn-button">
                                    {{ __('View Experiences') }}</a>
                                <a href="#contact" data-menuanchor="contact">{{ __('Contact Me') }}<div
                                        class="arrow-down icon animated-icon"></div></a>
                            </div>

                            @if ($partners->count() > 0)
                                <div class="partners__slider">
                                    @foreach ($partners as $partner)
                                        <div class="partners__slider_item">
                                            <img src="{{ $partner->image_path }}" alt="{{ $partner->name }} Image">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script type="text/javascript">
        $(".partners__slider")
            .not('.slick-initialized')
            .slick({
                infinite: true,
                autoplay: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 100,
                slidesToShow: 1,
                arrows: false,
                dots: false,
                variableWidth: true,
                centerMode: true
                // prevArrow: $(".prev-partner-item"),
                // nextArrow: $(".next-partner-item"),
            });
    </script>
@endpush
