<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="old_password">{{ __('Old Password') }}</label>
            <input type="password" class="form-control" wire:model.lazy='old_password'>
            @error('old_password')
                <div class="text-danger small">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="new_password">{{ __('New Password') }}</label>
            <input type="password" class="form-control" wire:model.lazy='new_password'>
            @error('new_password')
                <div class="text-danger small">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="confirmation_password">{{ __('Confirmation New Password') }}</label>
            <input type="password" class="form-control" wire:model.lazy='confirmation_password'>
            @error('confirmation_password')
                <div class="text-danger small">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary" wire:click='update_password' wire:loading.attr='disabled'>
            <i class="fas fa-save"></i>
            {{ __('Update Password') }}
        </button>
    </div>
</div>
