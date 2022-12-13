@extends('backend.layouts.app')

@section('title', $company->name)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Companies') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.company') }}">{{ __('Companies') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $company->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $company->name }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-3">
                                <img src="{{ $company->image_path }}" alt="{{ $company->name }} Image">
                                <div class="text-center my-3">
                                    <form class="d-inline" action="{{ route('dashboard.company.delete', $company->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-company" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.company.edit', $company->slug) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content">
                                    <div class="title">{{ $company->name }} ({{ $company->as_known }})</div>
                                    <div class="subtitle">
                                        <div class="link">
                                            @if ($company->url)
                                                <a href="{{ $company->url }}" data-toggle="tooltip"
                                                    title="{{ __('Visit') }}" target="_blank">
                                                    {{ $company->url }}
                                                </a>
                                            @else
                                                {{ __('No link added.') }}
                                            @endif
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $company->created_at->diffForHumans() }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            @if ($company->published_at)
                                                {{ __('Published at') }}
                                                {{ Carbon::parse($company->published_at)->diffForHumans() }}
                                            @else
                                                {{ __('Not yet published.') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tags">
                                        @foreach ($company->sectors as $sector)
                                            <div class="tag-item" style="background: {{ $sector->color }}">
                                                {{ $sector->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="body">
                                        {!! $company->description !!}
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#delete-company').on('click', (e) => {
            e.preventDefault()

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: `{{ __('Are you sure?') }}`,
                text: `{{ __('You wont be able to revert this!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `{{ __('Yes, delete it!') }}`,
                cancelButtonText: `{{ __('No, cancel!') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        `{{ __('Wait!') }}`,
                        `{{ __('The process is in progress.') }}`,
                        'success'
                    )
                    e.target.closest('form').submit()
                }
            })
        })
    </script>
@endpush
