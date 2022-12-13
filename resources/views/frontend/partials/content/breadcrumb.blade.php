<div class="section__breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">{{ __('Home') }}</a></li>
                @if ($breadcrumbs)
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($breadcrumb['status'] == 0)
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                        @endif
                    @endforeach
                @endif
            </ol>
        </nav>
    </div>
</div>
