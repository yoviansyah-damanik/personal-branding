<section class="section contact" id="eight">
    <div class="section__inner" id="contact-wave">
        <div class="section__inner-content">
            <div class="container">
                <div class="row row-margin align-items-center align-items-center">
                    <div class="col-lg-6">
                        <div class="contact__content col-margin" data-aos="fade-right">
                            <h2>{{ __('Let’s work together') }}</h2>
                            <h4>{{ __('Get in touch with me') }}</h4>
                            <p>{{ __('You can contact me via the form provided or the contact provided. In addition, you can follow my social media accounts to find out about my daily activities.') }}
                            </p>
                            <div class="social__wrapper">
                                <h6>{{ __('Follow Me') }}</h6>
                                <div class="social">
                                    @foreach ($_social_media as $item)
                                        <a href="{{ $item->url }}">
                                            <div class="icon"
                                                style="background:{{ $item->social_media_icon->color }}">
                                                <i class="{{ $item->social_media_icon->icon }}"></i>
                                            </div>
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-xl-5 offset-xl-1">
                        <div data-aos="fade-left">
                            <livewire:frontend.contact.index />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
