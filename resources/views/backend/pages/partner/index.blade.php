@extends('backend.layouts.app')

@section('title', __('Partners'))

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Partners') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Partners') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="section-title">{{ __('Create Partner') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.partner.create />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">{{ __('Partners Data') }}</h2>
                        <livewire:backend.partner.index />
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
