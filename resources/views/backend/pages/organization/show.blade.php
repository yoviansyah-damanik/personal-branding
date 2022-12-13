@extends('backend.layouts.app')

@section('title', $organization->name)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Organizations') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.organization') }}">{{ __('Organizations') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $organization->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $organization->name }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-3">
                                <img src="{{ $organization->image_path }}" alt="{{ $organization->name }} Image">
                                <div class="text-center my-3">
                                    <form class="d-inline"
                                        action="{{ route('dashboard.organization.delete', $organization->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-organization" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.organization.edit', $organization->slug) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content">
                                    <div class="title">{{ $organization->name }}</div>
                                    <div class="subtitle">
                                        <div class="period">
                                            {{ $organization->start_period_text }} -
                                            {{ $organization->end_period_text }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $organization->created_at->diffForHumans() }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            @if ($organization->published_at)
                                                {{ __('Published at') }}
                                                {{ Carbon::parse($organization->published_at)->diffForHumans() }}
                                            @else
                                                {{ __('Not yet published.') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="body">
                                        {!! $organization->description !!}
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
        $('#delete-organization').on('click', (e) => {
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
