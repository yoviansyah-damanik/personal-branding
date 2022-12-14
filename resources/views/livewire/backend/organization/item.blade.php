<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
    <article class="article article-style-b mb-0">
        <div class="article-header">
            <div class="article-image">
                <img src="{{ $organization->image_path }}" alt="{{ $organization->name }} Image">
            </div>

            <div class="article-badge">
                @if ($organization->status == 1)
                    <button class="article-badge-item bg-success"
                        wire:click="$emitUp('set_status_organization','published')">
                        <i class="fas fa-check"></i>
                        {{ __('Published') }}
                    </button>
                @else
                    <button class="article-badge-item bg-warning"
                        wire:click="$emitUp('set_status_organization','drafted')">
                        <i class="fas fa-file"></i>
                        {{ __('Drafted') }}
                    </button>
                @endif
                <div class="mt-2 article-badge-item" style="background:var(--teal)">
                    {{ $organization->start_period_text }} -
                    {{ $organization->end_period_text }}
                </div>
            </div>
        </div>
        <div class="article-details">
            <div class="article-title">
                <h2>
                    <a class="one-line-text" href="{{ route('dashboard.organization.show', $organization->slug) }}">
                        {{ $organization->name }}
                    </a>
                </h2>
            </div>

            <p class="three-line-text">
                {{ $organization->excerpt }}
            </p>
            <div class="small mb-2">
                <i class="fas fa-clock"></i> {{ $organization->created_at->diffForHumans() }}
            </div>
            <div class="article-cta d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <button class="btn btn-sm btn-dark" wire:click='delete_item' data-toggle="tooltip"
                        title="{{ __('Delete') }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <a class="btn btn-sm btn-warning"
                        href="{{ route('dashboard.organization.edit', $organization->slug) }}" data-toggle="tooltip"
                        title="{{ __('Edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($organization->status == 0)
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
                    href="{{ route('dashboard.organization.show', $organization->slug) }}">{{ __('Read More') }}
                    <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </article>
</div>
