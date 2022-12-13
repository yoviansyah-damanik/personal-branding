@extends('backend.layouts.app')

@section('title', __('Create Project'))

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Projects') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.project') }}">{{ __('Projects') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Create') }}</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ __('Create Project') }}</h2>
                <div class="card">
                    <form action="{{ route('dashboard.project.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4">
                                    <div class="form-group">
                                        <label for="image">{{ __('Image') }}</label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                            <input type="file" name="image" id="image-upload" accept="image/*"
                                                required />
                                            @error('image')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="title">{{ __('Project Title') }}</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ old('title') }}" required>
                                                @error('title')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="company">{{ __('Company') }}</label>
                                                <select name="company" id="company" class="form-control selectric"
                                                    required>
                                                    <option disabled hidden>--{{ __('Please select') }}--</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}"
                                                            {{ $company->id == old('company') ? 'selected' : '' }}>
                                                            {{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="url">{{ __('URL') }}</label>
                                                <input type="url" name="url" id="url" class="form-control"
                                                    value="{{ old('url') }}">
                                                @error('url')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">{{ __('Description') }}</label>
                                                <textarea class="summernote" name="description" required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-plus"></i>
                                                {{ __('Create Project') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend-assets/library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('backend-assets/library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('backend-assets/library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('backend-assets/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('backend-assets/js/page/features-post-create.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
