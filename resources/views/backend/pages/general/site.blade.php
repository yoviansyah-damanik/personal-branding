@extends('backend.layouts.app')

@section('title', __('Site'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Site') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.general') }}">{{ __('General') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Site') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Overview') }}</h2>
                <p class="section-lead">
                    {{ __('General settings such as site title, site description, address and so on.') }}
                </p>

                <livewire:backend.general.site />
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend-assets/library/upload-preview/upload-preview.js') }}"></script>
    <script type="text/javascript">
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Change File') }}",
            no_label: false,
            success_callback: null
        });

        $.uploadPreview({
            input_field: "#image-upload-2",
            preview_box: "#image-preview-2",
            label_field: "#image-label-2",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Change File') }}",
            no_label: false,
            success_callback: null
        });
    </script>
@endpush
