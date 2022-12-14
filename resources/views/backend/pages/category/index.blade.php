@extends('backend.layouts.app')

@section('title', __('Categories'))

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
