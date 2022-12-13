@extends('backend.layouts.app')

@section('title', $project->title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Projects') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.project') }}">{{ __('Projects') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $project->title }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $project->title }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-3">
                                <img src="{{ $project->image_path }}" alt="{{ $project->title }} Image">
                                <div class="text-center my-3">
                                    <form class="d-inline" action="{{ route('dashboard.project.delete', $project->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-project" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.project.edit', $project->slug) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content">
                                    <div class="title">{{ $project->title }}</div>
                                    <div class="subtitle">
                                        <div class="company">
                                            {{ $project->company->name }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="link">
                                            @if ($project->url)
                                                <a href="{{ $project->url }}" data-toggle="tooltip"
                                                    title="{{ __('Visit') }}" target="_blank">
                                                    {{ $project->url }}
                                                </a>
                                            @else
                                                {{ __('No link added.') }}
                                            @endif
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $project->created_at->diffForHumans() }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            @if ($project->published_at)
                                                {{ __('Published at') }}
                                                {{ Carbon::parse($project->published_at)->diffForHumans() }}
                                            @else
                                                {{ __('Not yet published.') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="body">
                                        {!! $project->description !!}
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
        $('#delete-project').on('click', (e) => {
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
