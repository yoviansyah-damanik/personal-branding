<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
    <article class="article article-style-b mb-0">
        <div class="article-details">
            <div class="article-title">
                <h2>
                    <a class="one-line-text" href="{{ route('dashboard.experience.show', $experience->slug) }}">
                        {{ $experience->name }}
                    </a>
                </h2>
            </div>

            <p class="three-line-text">
                {{ $experience->excerpt }}
            </p>

            <div style="font-size:.875em">
                @if ($experience->status == 1)
                    <button class="mb-2 rounded text-white px-3 bg-success" style="outline:none; border: none"
                        wire:click="$emitUp('set_status_experience','published')">
                        <i class="fas fa-check"></i>
                        {{ __('Published') }}
                    </button>
                @else
                    <button class="mb-2 rounded text-white px-3 bg-warning" style="outline:none; border: none"
                        wire:click="$emitUp('set_status_experience','drafted')">
                        <i class="fas fa-file"></i>
                        {{ __('Drafted') }}
                    </button>
                @endif
                <span class="mb-2 text-center rounded text-white px-3 py-1 bg-primary">
                    <i class="fas fa-person-walking-luggage"></i>
                    {{ $experience->position }}
                </span>
                <span class="mb-2 d-block text-center rounded text-white px-3 py-1" style="background: var(--teal)">
                    {{ $experience->start_period_text }} -
                    {{ $experience->end_period_text }}
                </span>
            </div>

            <div class="small mb-2">
                <i class="fas fa-clock"></i> {{ $experience->created_at->diffForHumans() }}
            </div>
            <div class="article-cta d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <button class="btn btn-sm btn-danger" wire:click='delete_item' data-toggle="tooltip"
                        title="{{ __('Delete') }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <a class="btn btn-sm btn-warning"
                        href="{{ route('dashboard.experience.edit', $experience->slug) }}" data-toggle="tooltip"
                        title="{{ __('Edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($experience->status == 0)
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
                <a data-toggle="tooltip" title="{{ __('Read More') }}" class="btn btn-sm btn-info"
                    href="{{ route('dashboard.experience.show', $experience->slug) }}">
                    <i class="fas fa-eye"></i></a>
            </div>
        </div>
    </article>
</div>
