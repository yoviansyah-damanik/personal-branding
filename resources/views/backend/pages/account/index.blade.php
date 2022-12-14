@extends('backend.layouts.app')

@section('title', __('Account'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Account') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">{{ __('Account') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Overview') }}</h2>
                <p class="section-lead">
                    {{ __('Manage account information and passwords here.') }}
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Account Information') }}</h4>
                                <p>{{ __('Your general account information can be changed here.') }}
                                </p>
                                <a href="{{ route('dashboard.account.information') }}"
                                    class="card-cta">{{ __('Change Setting') }}
                                    <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Password') }}</h4>
                                <p>{{ __('Please change your password regularly to avoid losing your account.') }}</p>
                                <a href="{{ route('dashboard.account.password') }}"
                                    class="card-cta">{{ __('Change Setting') }}
                                    <i class="fas fa-chevron-right"></i></a>
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
