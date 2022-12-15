@extends('backend.layouts.app')

@section('title', __('Site'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.css') }}">
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

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Application Logo') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.general.site.images') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="image">{{ __('Application Logo') }}</label>
                                        <div id="image-preview" class="image-preview"
                                            style="background-image:url('{{ $_app_logo ?? asset('branding-images/logo.png') }}'); background-size:cover; background-position:center center;">
                                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                            <input type="file" name="logo" id="image-upload" accept="image/*" />
                                            @error('logo')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{ __('Favicon Logo') }}</label>
                                        <div id="image-preview-2" class="image-preview"
                                            style="background-image:url('{{ $_app_favicon ?? asset('branding-images/favicon.png') }}'); background-size:cover; background-position:center center;">
                                            <label for="image-upload-2" id="image-label-2">{{ __('Choose File') }}</label>
                                            <input type="file" name="favicon" id="image-upload-2" accept="image/*" />
                                            @error('favicon')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{ __('Application Ads') }}</label>
                                        <div id="image-preview-3" class="image-preview"
                                            style="background-image:url('{{ $_app_ads ?? asset('branding-images/ads.png') }}'); background-size:cover; background-position:center center;">
                                            <label for="image-upload-3" id="image-label-3">{{ __('Choose File') }}</label>
                                            <input type="file" name="ads" id="image-upload-3" accept="image/*" />
                                            @error('ads')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        {{ __('Update Application Logo') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Application Information') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.general.site.information') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="app_name">{{ __('Application Name') }}</label>
                                                <input type="text" name="app_name" value="{{ $_app_name }}"
                                                    class="form-control" required>
                                                @error('app_name')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="app_abb_name">{{ __('Application Abbreviation Name') }}</label>
                                                <input type="text" name="app_abb_name" value="{{ $_app_abb_name }}"
                                                    class="form-control" required>
                                                @error('app_abb_name')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="app_description">{{ __('Application Description') }}</label>
                                                <textarea name="app_description" class="form-control" data-height="150" height=150 required>{{ $_app_description }}</textarea>
                                                @error('app_description')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="about_me">{{ __('About Me') }}</label>
                                                <textarea name="about_me" class="summernote" data-height="150" height=150 required>{{ $_about_me }}</textarea>
                                                @error('app_description')
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('Maintenance') }}</div>
                                                <label class="custom-switch mt-2 pl-0">
                                                    <input type="checkbox" name="maintenance" class="custom-switch-input"
                                                        {{ $_is_maintenance == 1 ? 'checked' : '' }}>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ __('The site will enter maintenance mode.') }}</span>
                                                </label>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                                {{ __('Update Application Information') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.js') }}"></script>
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

        $.uploadPreview({
            input_field: "#image-upload-3",
            preview_box: "#image-preview-3",
            label_field: "#image-label-3",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Change File') }}",
            no_label: false,
            success_callback: null
        });
    </script>
@endpush
