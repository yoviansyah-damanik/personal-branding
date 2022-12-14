<div>
    <div class="form-group" wire:ignore>
        <label for="frequency">{{ __('Frequency') }}</label>
        <select class="form-control selectric" id="frequency" wire:model="frequency">
            @foreach ($frequencies as $frequency)
                <option value="{{ $frequency }}">{{ __(Str::title($frequency)) }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <div class="control-label">{{ __('Priority') }}</div>
        <div class="custom-switches-stacked mt-2">
            <label class="custom-switch pl-0">
                <input type="radio" name="option" value="0" class="custom-switch-input" wire:model="priority">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">{{ __('No Priority') }}</span>
            </label>
            <label class="custom-switch pl-0">
                <input type="radio" name="option" value="1" class="custom-switch-input" wire:model="priority">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">{{ __('Automatic') }}</span>
            </label>
        </div>
    </div>

    <button class="btn btn-primary" wire:click="update_sitemap" wire:loading.attr='disabled'>
        <i class="fas fa-save"></i>
        {{ __('Update Sitemap') }}
    </button>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#frequency').on('change', () => {
            var data = $('#frequency').val()
            @this.set('frequency', data)
        })
    </script>
@endpush
