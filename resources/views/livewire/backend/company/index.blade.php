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
                                    <span class="badge badge-primary">{{ $company_total }}</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if ($status == 'drafted') active @endif"
                                    wire:click="set_status('drafted')">
                                    {{ __('Drafted') }}
                                    <span class="badge badge-primary">{{ $company_drafted }}</span>
                                </button>
                            </li>
                            <li class="nav-item mr-3">
                                <button class="nav-link @if ($status == 'published') active @endif"
                                    wire:click="set_status('published')">
                                    {{ __('Published') }}
                                    <span class="badge badge-primary">{{ $company_published }}</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <div class="row align-items-center mr-3" style="min-width:250px;" wire:ignore>
                                    <label class="col-5 mb-0 text-right" for="sector">{{ __('Sector') }}</label>
                                    <select class="col-7 form-control select h-auto py-1 px-2" id="sector">
                                        <option value="all">--{{ __('Select All') }}--</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <a class="mt-3 mt-lg-0 btn btn-primary" href="{{ route('dashboard.company.create') }}">
                            <i class="fas fa-plus"></i>
                            {{ __('Create Company') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        @forelse($companies as $company)
            <livewire:backend.company.item :company="$company" :wire:key="rand()" />
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

    {{ $companies->links() }}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#sector').on('change', () => {
            var data = $('#sector').val()
            @this.set('sector_id', data)
        })
    </script>
@endpush
