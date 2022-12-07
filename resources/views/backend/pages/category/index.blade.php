@extends('backend.layouts.app')

@section('title', __('Categories'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Categories') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Categories') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="section-title">{{ __('Edit Category') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.category.edit />
                            </div>
                        </div>

                        <h2 class="section-title">{{ __('Create Category') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.category.create />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">{{ __('Categories Data') }}</h2>
                        <livewire:backend.category.index />
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.delete-category').on('click', (e) => {
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
