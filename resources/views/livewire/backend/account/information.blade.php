<div>
    <div class="form-group">
        <label for="username">{{ __('Username') }}</label>
        <input type="text" wire:model.lazy='username' class="form-control">
        @error('username')
            <div class="text-danger small">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">{{ __('Account Name') }}</label>
        <input type="text" wire:model.lazy='name' class="form-control">
        @error('name')
            <div class="text-danger small">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input type="text" wire:model.lazy='email' class="form-control">
        @error('email')
            <div class="text-danger small">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button class="btn btn-primary" wire:click='update_information_account' wire:loading.attr='disabled'>
        <i class="fas fa-save"></i>
        {{ __('Update Information Account') }}
    </button>
</div>
