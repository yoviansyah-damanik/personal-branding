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
        @forelse ($categories as $category)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="font-weight-bold">
                            {{ $category->name }}
                        </div>
                        <div class="small font-italic">
                            {{ __('Blog Total') }}: {{ $category->blogs_count }}
                        </div>

                        <div class="mt-1">
                            <button class="btn btn-sm btn-danger" wire:click="delete_item({{ $category->id }})"
                                data-toggle="tooltip" data-placement="bottom" title="{{ __('Delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom"
                                title="{{ __('Edit') }}" wire:click="edit_category({{ $category->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
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

    {{ $categories->links() }}
</div>
