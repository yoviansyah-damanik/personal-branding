@extends('backend.layouts.app')

@section('title', __('Social Media'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend-assets/library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Social Media') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Social Media') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Overview') }}</h2>
                <p class="section-lead">
                    {{ __('Social media functions so that visitors can interact with you further.') }}
                </p>

                <div class="row mt-4">
                    <div class="col-lg-4">
                        <h2 class="section-title">{{ __('Create Social Media') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.general.social-media.create />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">{{ __('Social Media Data') }}</h2>
                        <livewire:backend.general.social-media.index />
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend-assets/library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
