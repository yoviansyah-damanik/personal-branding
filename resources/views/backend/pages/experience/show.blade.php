@extends('backend.layouts.app')

@section('title', $experience->name)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Experiences') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.experience') }}">{{ __('Experiences') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $experience->title }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $experience->name }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="article-content">
                            <div class="content">
                                <div class="title">{{ $experience->name }}</div>
                                <div class="subtitle">
                                    <div class="position">
                                        <i class="fas fa-person-walking-luggage"></i>
                                        <span class="ml-2">
                                            {{ $experience->position }}
                                        </span>
                                    </div>
                                    <div class="divide"></div>
                                    <div class="period">
                                        {{ $experience->start_period_text }} -
                                        {{ $experience->end_period_text }}
                                    </div>
                                    <div class="divide"></div>
                                    <div class="time">
                                        <i class="fas fa-clock"></i>
                                        {{ $experience->created_at->diffForHumans() }}
                                    </div>
                                    <div class="divide"></div>
                                    <div class="time">
                                        @if ($experience->published_at)
                                            {{ __('Published at') }}
                                            {{ Carbon::parse($experience->published_at)->diffForHumans() }}
                                        @else
                                            {{ __('Not yet published.') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="my-3">
                                    <form class="d-inline"
                                        action="{{ route('dashboard.experience.delete', $experience->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-experience" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.experience.edit', $experience->slug) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>

                                <div class="body">
                                    {!! $experience->description !!}
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
        $('#delete-experience').on('click', (e) => {
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
