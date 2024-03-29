<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
    <article class="article article-style-b mb-0">
        <div class="article-header">
            <div class="article-image">
                <img src="{{ $project->image_path }}" alt="{{ $project->title }} Image">
            </div>
            <div class="article-badge" style="top:10px;left:10px;">
                <span class="article-badge-item bg-white text-body">
                    <i class="fas fa-building"></i>
                    {{ $project->company->name }}
                </span>
            </div>
            <div class="article-badge d-flex">
                @if ($project->status == 1)
                    <button class="article-badge-item bg-success" wire:click="$emitUp('set_status_project',1)">
                        <i class="fas fa-check"></i>
                        {{ __('Published') }}
                    </button>
                @else
                    <button class="article-badge-item bg-warning" wire:click="$emitUp('set_status_project',0)">
                        <i class="fas fa-file"></i>
                        {{ __('Drafted') }}
                    </button>
                @endif
                @if ($project->url)
                    <a href="{{ $project->url }}" target="_blank" class="ml-2 article-badge-item bg-primary"
                        data-toggle="tooltip" title="{{ __('Visit') }}">
                        <i class="fas fa-link"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="article-details">
            <div class="article-title">
                <h2>
                    <a class="one-line-text" href="{{ route('dashboard.project.show', $project->slug) }}">
                        {{ $project->title }}
                    </a>
                </h2>
            </div>

            <p class="three-line-text">
                {{ $project->excerpt }}
            </p>
            <div class="small mb-2">
                <i class="fas fa-clock"></i> {{ $project->created_at->diffForHumans() }}
            </div>
            <div class="article-cta d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <button class="btn btn-sm btn-danger" wire:click="delete_item" data-toggle="tooltip"
                        title="{{ __('Delete') }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.project.edit', $project->slug) }}"
                        data-toggle="tooltip" title="{{ __('Edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($project->status == 0)
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
                    href="{{ route('dashboard.project.show', $project->slug) }}">
                    <i class="fas fa-eye"></i></a>
            </div>
        </div>
    </article>
</div>
