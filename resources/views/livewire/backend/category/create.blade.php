<div>
    <div class="form-group">
        <label for="name">{{ __('Category Name') }}</label>
        <input type="text" class="form-control" wire:model="name">
        @error('name')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary" wire:click="store_category" wire:loading.attr='disabled'>
        <i class="fas fa-plus"></i>
        {{ __('Create Category') }}
    </button>
</div>
