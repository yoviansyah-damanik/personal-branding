@extends('backend.layouts.app')

@section('title', __('SEO'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend-assets/library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('SEO') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.general') }}">{{ __('General') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('SEO') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Overview') }}</h2>
                <p class="section-lead">
                    {{ __('Search engine optimization settings, such as meta tags and social media.') }}
                </p>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Sitemap') }}</h4>
                            </div>
                            <div class="card-body">
                                <livewire:backend.general.seo.sitemap />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Keywords') }}</h4>
                            </div>
                            <div class="card-body">
                                <livewire:backend.general.seo.keyword />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend-assets/library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
