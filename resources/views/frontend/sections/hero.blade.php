<section class="section hero" id="one">
    <div class="section__inner">
        <img src="{{ asset('frontend-assets/images/asset.jpg') }}" alt="Image" class="anim max-width-unset" />
        <div class="section__inner-content" data-background="{{ asset('frontend-assets/images/profile.png') }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="hero__content" data-aos="fade-right">
                            <a class="hero__popup" href="https://www.youtube.com/watch?v=K8ixLPaenM8" target="_blank"
                                title="YouTube video player">
                                <i class="fa-solid fa-play"></i>
                            </a>
                            <h5 class="hero__subtitle">{{ __("Hi, I'm An Optimist!") }}</h5>
                            <h2 class="hero__title"><span class="typed">Developer</span></h2>
                            <p class="hero__text">Kota Padang Sidempuan, Sumatera Utara, Indonesia.</p>
                            <div class="hero__cta">
                                <a href="#experience" data-menuanchor="experience" class="cmn-button">
                                    {{ __('View Experiences') }}</a>
                                <a href="#contact" data-menuanchor="contact">{{ __('Contact Me') }}<div
                                        class="arrow-down icon animated-icon"></div></a>
                            </div>
                            {{-- TAMBAH LOGO BISNIS --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
