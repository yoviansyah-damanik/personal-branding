<div>
    @if ($isVisible === true)
        <div class="form-group">
            <label for="name">{{ __('Category Name') }}</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name')
                <div class="small text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary" wire:click="update_category" wire:loading.attr='disabled'>
            <i class="fas fa-edit"></i>
            {{ __('Edit Category') }}
        </button>
    @else
        {{ __('Please select the category to be edited first.') }}
    @endif
</div>
