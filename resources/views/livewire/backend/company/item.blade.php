<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
    <article class="article article-style-b mb-0">
        <div class="article-header">
            <div class="article-image">
                <img src="{{ $company->image_path }}" alt="{{ $company->name }} Image">
            </div>
            <div class="article-badge d-flex">
                @if ($company->status == 1)
                    <button class="article-badge-item bg-success" wire:click="$emitUp('set_status_company','published')">
                        <i class="fas fa-check"></i>
                        {{ __('Published') }}
                    </button>
                @else
                    <button class="article-badge-item bg-warning" wire:click="$emitUp('set_status_company','drafted')">
                        <i class="fas fa-file"></i>
                        {{ __('Drafted') }}
                    </button>
                @endif
                @if ($company->url)
                    <a href="{{ $company->url }}" target="_blank" class="ml-2 article-badge-item bg-primary"
                        data-toggle="tooltip" title="{{ __('Visit') }}">
                        <i class="fas fa-link"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="article-details">
            <div class="article-title">
                <h2>
                    <a class="one-line-text" href="{{ route('dashboard.company.show', $company->slug) }}">
                        {{ $company->name }} ({{ $company->as_known }})
                    </a>
                </h2>
            </div>

            <p class="three-line-text">
                {{ $company->excerpt }}
            </p>
            <div class="small mb-2">
                <i class="fas fa-clock"></i> {{ $company->created_at->diffForHumans() }}
            </div>
            <div class="tags">
                @forelse ($company->sectors as $sector)
                    <button wire:click="$emitUp('filter_by_sector',{{ $sector->id }})" class="tag-item"
                        style="background: {{ $sector->color }}" title="{{ $sector->name }}">
                        {{ $sector->name }}
                    </button>
                @empty
                    {{ __('No embedded sectors.') }}
                @endforelse
            </div>
            <div class="article-cta d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <form action="{{ route('dashboard.company.delete', $company->slug) }}"
                        method="post"class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-dark delete-company" data-toggle="tooltip"
                            title="{{ __('Delete') }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.company.edit', $company->slug) }}"
                        data-toggle="tooltip" title="{{ __('Edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($company->status == 0)
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
                    href="{{ route('dashboard.company.show', $company->slug) }}">{{ __('Read More') }}
                    <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </article>
</div>
