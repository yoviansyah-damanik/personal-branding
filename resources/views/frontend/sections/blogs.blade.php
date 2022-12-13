<section class="section blogs" id="seven">
    <div class="section__inner">
        <div class="anim-wrapper">
            <canvas id="bubble"></canvas>
        </div>
        <div class="section__inner-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="section__title" data-aos="fade-left">{{ __('Blogs') }}</h5>
                        <h5 class="section__subtitle" data-aos="fade-right">
                            {{ __('You can find out about my daily activities through the blog that I write.') }}
                        </h5>

                        <div class="blog__content" data-aos="fade-up">
                            <div class="row">
                                @foreach ($blogs as $blog)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="blog__card">
                                            <div class="blog__image">
                                                <img src="{{ $blog->image_path }}" alt="{{ $blog->title }} Image">
                                                <img class="mirror" src="{{ $blog->image_path }}"
                                                    alt="{{ $blog->title }} Image">
                                            </div>
                                            <div class="blog__body">
                                                <div class="blog__title">
                                                    {{ $blog->title }}
                                                </div>
                                                <div class="blog__tags">
                                                    @if ($blog->tags)
                                                        @foreach ($blog->tags as $tag)
                                                            <span class="blog__tag"
                                                                style="background: {{ $tag->color }}">
                                                                {{ $tag->name }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        {{ __('No embedded tags.') }}
                                                    @endif
                                                </div>
                                                <div class="blog__excerpt">
                                                    {{ $blog->excerpt }}
                                                </div>

                                                <div class="blog__detail">
                                                    <div class="blog__time">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $blog->created_at->diffForHumans() }}
                                                    </div>
                                                    <div class="blog__category">
                                                        <i class="fas fa-shapes"></i>
                                                        {{ $blog->category->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="stretched-link" href="{{ route('blog.show', $blog->slug) }}"></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if ($blogs->count())
                            <div class="text-center" data-aos="fade-down">
                                <a href="{{ route('blog') }}" class="view_all">
                                    {{ __('View More') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
