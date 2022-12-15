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
        @forelse ($partners as $partner)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img class="img-fluid" src="{{ $partner->image_path }}"
                                    alt="{{ $partner->name }} Image">
                            </div>
                            <div class="col-8">
                                <div class="font-weight-bold">
                                    {{ $partner->name }}
                                </div>
                                <div class="mt-1">
                                    <button class="btn btn-sm btn-danger" wire:click="delete_item({{ $partner->id }})"
                                        data-toggle="tooltip" data-placement="bottom" title="{{ __('Delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    {{ $partners->links() }}
</div>
