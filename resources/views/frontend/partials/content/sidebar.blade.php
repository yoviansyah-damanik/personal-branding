<div class="d-block d-lg-none mb-md-3 mb-lg-0 divide">
    <div class="circle"></div>
</div>

<div class="section__sidebar">
    <div class="section__sidebar_title">
        {{ __('My Companies') }}
    </div>
    <div class="section__sidebar_content">
        @if ($_other_company->count() > 0)
            <ul>
                @foreach ($_other_company as $item)
                    <li>
                        <a href="{{ route('company.show', $item->slug) }}">
                            <div class="image">
                                <img src="{{ $item->image_path }}" alt="{{ $item->name }} Image">
                            </div>
                            <div class="detail">
                                <div class="name">
                                    {{ $item->name }}
                                </div>
                                <div class="created_at">
                                    <i class="fas fa-clock"></i>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-3">
                <a class="view-more" href="{{ route('company') }}">{{ __('View More') }}</a>
            </div>
        @else
            {{ __('No data found') }}
        @endif
    </div>
    <div class="section__sidebar_divide"></div>
    <div class="section__sidebar_title">
        {{ __('My Organizations') }}
    </div>
    <div class="section__sidebar_content">
        @if ($_other_organization->count() > 0)
            <ul>
                @foreach ($_other_organization as $item)
                    <li>
                        <a href="{{ route('organization.show', $item->slug) }}">
                            <div class="image">
                                <img src="{{ $item->image_path }}" alt="{{ $item->name }} Image">
                            </div>
                            <div class="detail">
                                <div class="name">
                                    {{ $item->name }}
                                </div>
                                <div class="created_at">
                                    <i class="fas fa-clock"></i>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-3">
                <a class="view-more" href="{{ route('organization') }}">{{ __('View More') }}</a>
            </div>
        @else
            {{ __('No data found') }}
        @endif
    </div>
    <div class="section__sidebar_divide"></div>
    <div class="section__sidebar_title">
        {{ __('My Socials') }}
    </div>
    <div class="section__sidebar_content">
        @if ($_other_social->count() > 0)
            <ul>
                @foreach ($_other_social as $item)
                    <li>
                        <a href="{{ route('social.show', $item->slug) }}">
                            <div class="image">
                                <img src="{{ $item->image_path }}" alt="{{ $item->name }} Image">
                            </div>
                            <div class="detail">
                                <div class="name">
                                    {{ $item->name }}
                                </div>
                                <div class="created_at">
                                    <i class="fas fa-clock"></i>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-3">
                <a class="view-more" href="{{ route('social') }}">{{ __('View More') }}</a>
            </div>
        @else
            {{ __('No data found') }}
        @endif
    </div>
    <div class="section__sidebar_divide"></div>
    <div class="section__sidebar_title">
        {{ __('My Blogs') }}
    </div>
    <div class="section__sidebar_content">
        @if ($_other_blog->count() > 0)
            <ul>
                @foreach ($_other_blog as $item)
                    <li>
                        <a href="{{ route('blog.show', $item->slug) }}">
                            <div class="image">
                                <img src="{{ $item->image_path }}" alt="{{ $item->title }} Image">
                            </div>
                            <div class="detail">
                                <div class="name">
                                    {{ $item->title }}
                                </div>
                                <div class="created_at">
                                    <i class="fas fa-clock"></i>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-3">
                <a class="view-more" href="{{ route('blog') }}">{{ __('View More') }}</a>
            </div>
        @else
            {{ __('No data found') }}
        @endif
    </div>
</div>
