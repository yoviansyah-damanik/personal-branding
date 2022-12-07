<div>
    <div class="form-group">
        <label for="name">{{ __('Sector Name') }}</label>
        <input type="text" class="form-control" wire:model="name">
        @error('name')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="color">{{ __('Sector Color') }}</label>
        <input type="color" class="form-control" wire:model="color">
        @error('color')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary" wire:click="store_sector" wire:loading.attr='disabled'>
        <i class="fas fa-plus"></i>
        {{ __('Create Sector') }}
    </button>
</div>
