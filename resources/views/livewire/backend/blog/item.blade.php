<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
    <article class="article article-style-b mb-0">
        <div class="article-header">
            <div class="article-image">
                <img src="{{ $blog->image_path }}" alt="{{ $blog->title }} Image">
            </div>
            <div class="article-badge">
                @if ($blog->status == 1)
                    <button class="article-badge-item bg-success" wire:click="$emitUp('set_status_blog','published')">
                        <i class="fas fa-check"></i>
                        {{ __('Published') }}
                    </button>
                @else
                    <button class="article-badge-item bg-warning" wire:click="$emitUp('set_status_blog','drafted')">
                        <i class="fas fa-file"></i>
                        {{ __('Drafted') }}
                    </button>
                @endif
                <div>
                    <button wire:click="$emitUp('filter_by_category',{{ $blog->category_id }})"
                        class="mt-2 article-badge-item bg-dark">
                        <i class="fas fa-shapes"></i>
                        {{ $blog->category->name }}
                    </button>
                </div>
            </div>
        </div>
        <div class="article-details">
            <div class="article-title">
                <h2>
                    <a class="one-line-text" href="{{ route('dashboard.blog.show', $blog->slug) }}">
                        {{ $blog->title }}
                    </a>
                </h2>
            </div>

            <p class="three-line-text">
                {{ $blog->excerpt }}
            </p>
            <div class="small mb-2">
                <i class="fas fa-clock"></i> {{ $blog->created_at->diffForHumans() }}
            </div>
            <div class="tags">
                @forelse ($blog->tags as $tag)
                    <button wire:click="$emitUp('filter_by_tag',{{ $tag->id }})" class="tag-item"
                        style="background: {{ $tag->color }}" title="{{ $tag->name }}">
                        {{ $tag->name }}
                    </button>
                @empty
                    {{ __('No embedded tags.') }}
                @endforelse
            </div>
            <div class="article-cta d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <form action="{{ route('dashboard.blog.delete', $blog->slug) }}" method="post"class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-dark delete-blog" data-toggle="tooltip"
                            title="{{ __('Delete') }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.blog.edit', $blog->slug) }}"
                        data-toggle="tooltip" title="{{ __('Edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($blog->status == 0)
                        <button class="btn btn-sm btn-success" wire:click='publish' data-toggle="tooltip"
                            title="{{ __('Publish') }}">
                            <i class="fas fa-file-arrow-up"></i>
                        </button>
                    @else
                        <button class="btn btn-sm btn-danger" wire:click='unpublish' data-toggle="tooltip"
                            title="{{ __('Unpublish') }}">
                            <i class="fas fa-file-arrow-down"></i>
                        </button>
                    @endif
                </div>
                <a class="btn btn-sm btn-info"
                    href="{{ route('dashboard.blog.show', $blog->slug) }}">{{ __('Read More') }}
                    <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </article>
</div>
