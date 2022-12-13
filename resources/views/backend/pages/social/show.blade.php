@extends('backend.layouts.app')

@section('title', $social->name)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Socials') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.social') }}">{{ __('Socials') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $social->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $social->name }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-3">
                                <img src="{{ $social->image_path }}" alt="{{ $social->name }} Image">
                                <div class="text-center my-3">
                                    <form class="d-inline" action="{{ route('dashboard.social.delete', $social->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-social" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.social.edit', $social->slug) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content">
                                    <div class="title">{{ $social->name }}</div>
                                    <div class="subtitle">
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $social->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="body">
                                        {!! $social->description !!}
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
        $('#delete-social').on('click', (e) => {
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
