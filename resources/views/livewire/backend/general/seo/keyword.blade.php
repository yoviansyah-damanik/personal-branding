<div>
    <div class="form-group">
        <label for="keyword">{{ __('Keyword') }}</label>
        <input type="text" wire:model='keyword' wire:keyup.enter='store_keyword' class="form-control">
        @error('keyword')
            <div class="text-danger small">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="keywords">
        @if (count($keywords) > 0)
            @foreach ($keywords as $keyword)
                <div class="keyword-item">
                    {{ $keyword }}
                    <span wire:click="delete_keyword('{{ $keyword }}')">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            @endforeach
        @endif
    </div>


    <button class="btn btn-primary" wire:click='store_keyword' wire:loading.attr='disabled'>
        <i class="fas fa-plus"></i>
        {{ __('Create Keyword') }}
    </button>
</div>
