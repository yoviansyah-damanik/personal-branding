@extends('backend.layouts.app')

@section('title', __('Password'))

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Password') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.homepage') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.account') }}">{{ __('Account') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Password') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Edit Password') }}</h2>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <livewire:backend.account.password />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
