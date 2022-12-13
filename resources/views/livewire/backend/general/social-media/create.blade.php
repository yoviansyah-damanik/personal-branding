<div>
    <div class="form-group">
        <label for="name">{{ __('Account Name') }}</label>
        <input type="name" class="form-control" wire:model.lazy="name">
        @error('name')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <div wire:ignore>
            <label for="type">{{ __('Type') }}</label>
            <select class="form-control selectric" id="social_media_icon_id" wire:model.lazy='social_media_icon_id'>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        @error('social_media_icon_id')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="url">{{ __('URL') }}</label>
        <input type="url" class="form-control" wire:model.lazy="url">
        @error('url')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary" wire:click="store_social_media" wire:loading.attr='disabled'>
        <i class="fas fa-plus"></i>
        {{ __('Create Social Media') }}
    </button>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#social_media_icon_id').on('change', (e) => {
            @this.set('social_media_icon_id', e.target.value)
        })
    </script>
@endpush
