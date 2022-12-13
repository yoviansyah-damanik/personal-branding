<div>
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <input wire:model.500ms="s" type="text" class="form-control"
                    placeholder="{{ __('Enter some letters to search') }}">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row">
                        <ul class="nav nav-pills align-items-center">
                            <li class="nav-item mr-3">
                                <button class="nav-link bg-danger text-white" wire:click="refresh_all"
                                    wire:loading.attr="disabled">
                                    {{ __('Refresh All') }}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if ($status == 'all') active @endif"
                                    wire:click="set_status('all')">
                                    {{ __('All') }}
                                    <span class="badge badge-primary">{{ $organization_total }}</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if ($status == 'drafted') active @endif"
                                    wire:click="set_status('drafted')">
                                    {{ __('Drafted') }}
                                    <span class="badge badge-primary">{{ $organization_drafted }}</span>
                                </button>
                            </li>
                            <li class="nav-item mr-3">
                                <button class="nav-link @if ($status == 'published') active @endif"
                                    wire:click="set_status('published')">
                                    {{ __('Published') }}
                                    <span class="badge badge-primary">{{ $organization_published }}</span>
                                </button>
                            </li>
                        </ul>
                        <a class="mt-3 mt-lg-0 btn btn-primary" href="{{ route('dashboard.organization.create') }}">
                            <i class="fas fa-plus"></i>
                            {{ __('Create Organization') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        @forelse($organizations as $organization)
            <livewire:backend.organization.item :organization="$organization" :wire:key="rand()" />
        @empty
            <div class="col-12">
                <div class="alert alert-primary alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Ooopppsss!</div>
                        {{ __('No data found.') }}
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{ $organizations->links() }}
</div>
