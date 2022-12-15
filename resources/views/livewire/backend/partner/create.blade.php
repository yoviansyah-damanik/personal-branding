<div>
    <div class="form-group">
        <label for="image">{{ __('Image') }}</label>
        <div id="image-preview" class="image-preview" wire:ignore>
            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
            <input type="file" wire:model.lazy="image" id="image-upload" accept="image/*" required />
        </div>
        @error('image')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">{{ __('Partner Name') }}</label>
        <input type="text" class="form-control" wire:model.lazy='name'>
        @error('name')
            <div class="small text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button class="btn btn-primary" id="submit_partner" wire:click="store_partner" wire:loading.attr='disabled'>
        <i class="fas fa-plus"></i>
        {{ __('Create Partner') }}
    </button>
</div>

@push('scripts')
    <script src="{{ asset('backend-assets/library/upload-preview/upload-preview.js') }}"></script>

    <script type="text/javascript">
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Change File') }}",
            no_label: false,
            success_callback: null
        });

        $(document).on('resetPreview', () => {
            $('#image-preview').removeAttr('style')
        })

        $('#submit_partner').on('click', () => {
            var data = $('#image-upload').files[0]
            @this.set('image', data)
        })
    </script>
@endpush
