@extends('backend.layouts.app')

@section('title', __('Sectors'))

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Sectors') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Sectors') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="section-title">{{ __('Edit Sector') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.sector.edit />
                            </div>
                        </div>

                        <h2 class="section-title">{{ __('Create Sector') }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.sector.create />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">{{ __('Sectors Data') }}</h2>
                        <livewire:backend.sector.index />
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
