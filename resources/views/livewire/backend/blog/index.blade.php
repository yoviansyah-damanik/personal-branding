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
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row">
                        <ul class="nav nav-pills align-items-center">
                            <li class="nav-item mr-3">
                                <button class="nav-link bg-danger text-white" wire:click="refresh_all">
                                    {{ __('Refresh All') }}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if ($status == 'all') active @endif"
                                    wire:click="set_status('all')">
                                    {{ __('All') }}
                                    <span class="badge badge-primary">{{ $blog_total }}</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if ($status == 0) active @endif"
                                    wire:click="set_status(0)">
                                    {{ __('Drafted') }}
                                    <span class="badge badge-primary">{{ $blog_drafted }}</span>
                                </button>
                            </li>
                            <li class="nav-item mr-3">
                                <button class="nav-link @if ($status == 1) active @endif"
                                    wire:click="set_status(1)">
                                    {{ __('Published') }}
                                    <span class="badge badge-primary">{{ $blog_published }}</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <div class="row align-items-center mr-3" style="min-width:250px;" wire:ignore>
                                    <label class="col-5 mb-0 text-right" for="category">{{ __('Category') }}</label>
                                    <select class="col-7 form-control select h-auto py-1 px-2" id="category">
                                        <option value="all">--{{ __('Select All') }}--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="row align-items-center" style="min-width:250px;" wire:ignore>
                                    <label class="col-5 mb-0 text-right" for="tag">{{ __('Tag') }}</label>
                                    <select class="col-7 form-control select h-auto py-1 px-2" id="tag">
                                        <option value="all">--{{ __('Select All') }}--</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <a class="mt-3 mt-lg-0 btn btn-primary" href="{{ route('dashboard.blog.create') }}">
                            <i class="fas fa-plus"></i>
                            {{ __('Create Blog') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        @forelse($blogs as $blog)
            <livewire:backend.blog.item :blog="$blog" :wire:key="rand()" />
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

    {{ $blogs->links() }}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#category').on('change', () => {
            var data = $('#category').val()
            @this.set('category_id', data)
        })
        $('#tag').on('change', () => {
            var data = $('#tag').val()
            @this.set('tag_id', data)
        })
    </script>
@endpush
