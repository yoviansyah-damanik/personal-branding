@extends('backend.layouts.app')

@section('title', __('General'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('General') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">{{ __('General') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Overview') }}</h2>
                <p class="section-lead">
                    {{ __('Organize and adjust all settings about this site.') }}
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Site') }}</h4>
                                <p>{{ __('General settings such as, site title, site description, address and so on.') }}
                                </p>
                                <a href="{{ route('dashboard.general.site') }}" class="card-cta">{{ __('Change Setting') }}
                                    <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="card-body">
                                <h4>SEO</h4>
                                <p>{{ __('Search engine optimization settings, such as meta tags and social media.') }}</p>
                                <a href="{{ route('dashboard.general.seo') }}" class="card-cta">{{ __('Change Setting') }}
                                    <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Social Media') }}</h4>
                                <p>{{ __('Social media functions so that visitors can interact with you further.') }}</p>
                                <a href="{{ route('dashboard.general.social_media') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
