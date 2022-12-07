@extends('backend.layouts.app')

@section('title', __('Tags'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Tags') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tags') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="section-title">{{ __('Edit Tag') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.tag.edit />
                            </div>
                        </div>

                        <h2 class="section-title">{{ __('Create Tag') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.tag.create />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">{{ __('Tags Data') }}</h2>
                        <livewire:backend.tag.index />
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.delete-tag').on('click', (e) => {
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
