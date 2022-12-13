<section class="section companies" id="three">
    <div class="section__inner">
        <div class="anim-wrapper">
            <canvas id="bubble"></canvas>
        </div>
        <div class="section__inner-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="companies__slider" data-aos="fade-up">
                            @foreach ($companies as $company)
                                <div class="companies__slider-single">
                                    <div class="row align-items-center row-margin">
                                        <div class="col-lg-6 col-xl-7">
                                            <div class="companies__thumb col-margin">
                                                <img src="{{ $company->image_path }}"
                                                    alt="{{ $company->name }} Image" />
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-lg-6 col-xl-5">
                                            <div class="companies__content col-margin">
                                                <h5>{{ __('Featured Company') }}</h5>
                                                <h2>{{ $company->as_known }}</h2>
                                                <p class="mb-3">{{ $company->name }}</p>
                                                <p>{{ $company->excerpt }}</p>
                                                <div
                                                    class="companies__content-tag justify-content-center justify-content-sm-around">
                                                    @foreach ($company->sectors as $sector)
                                                        <span>{{ $sector->name }}</span>
                                                    @endforeach
                                                </div>
                                                <div class="company__content-demo">
                                                    <a href="{{ route('company.show', $company->slug) }}"
                                                        target="_blank">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    @if ($company->url)
                                                        <a href="{{ $company->url }}" target="_blank">
                                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="companies__slider-nav d-flex justify-content-center justify-content-sm-end">
                            <button class="next-company-item">
                                <i class="gg-arrow-long-left"></i>
                            </button>
                            <button class="prev-company-item">
                                <i class="gg-arrow-long-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
