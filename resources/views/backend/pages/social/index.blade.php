@extends('backend.layouts.app')

@section('title', __('Socials'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Socials') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Socials') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Socials Data') }}</h2>
                <livewire:backend.social.index />
            </div>
        </section>
    </div>
@endsection
