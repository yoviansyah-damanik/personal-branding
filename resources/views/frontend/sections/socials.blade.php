<section class="section socials" id="six">
    <div class="section__inner">
        <div class="anim-wrapper">
            <canvas id="bubble"></canvas>
        </div>
        <div class="section__inner-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="socials__side" data-aos="fade-right">
                            <h5 class="socials__title" data-aos="fade-left">{{ __('Socials') }}</h5>
                            <p class="socials__subtitle" data-aos="fade-right">
                                {{ __('Social activities that I routinely do without strings attached. Caring can grow for many reasons. Sensitivity of feelings will make us think about the actions we will take. Will we just sympathize or will we empathize to provide action.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="socials__slider" data-aos="fade-up">
                            @foreach ($socials as $social)
                                <div class="social__card">
                                    <div class="social__image">
                                        <img src="{{ $social->image_path }}" alt="{{ $social->name }} Image">
                                    </div>
                                    <div class="social__body">
                                        <div class="social__name">
                                            {{ $social->name }}
                                        </div>
                                        <div class="social__excerpt">
                                            {{ $social->excerpt }}
                                        </div>

                                        <div class="social__detail">
                                            <div class="social__time">
                                                <i class="fas fa-clock"></i>
                                                {{ $social->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <a class="stretched-link" href="{{ route('social.show', $social->slug) }}"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="socials__slider-nav d-flex justify-content-center justify-content-sm-end">
                        <button class="next-social-item">
                            <i class="gg-arrow-long-left"></i>
                        </button>
                        <button class="prev-social-item">
                            <i class="gg-arrow-long-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
