@extends('backend.layouts.app')

@section('title', __('Edit Oganization'))

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
                <h1>{{ __('Oganizations') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.organization') }}">{{ __('Oganizations') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Edit') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Edit Oganization') }}</h2>

                <div class="card">
                    <form action="{{ route('dashboard.organization.update', $organization->slug) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="image">{{ __('Image') }}</label>
                                                <div id="image-preview" class="image-preview"
                                                    style="background-image:url('{{ $organization->image_path }}'); background-size:cover; background-position:center center;">
                                                    <label for="image-upload"
                                                        id="image-label">{{ __('Choose File') }}</label>
                                                    <input type="file" name="image" id="image-upload"
                                                        accept="image/*" />
                                                    @error('image')
                                                        <div class="small text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">{{ __('Organization Name') }}</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name', $organization->name) }}" required>
                                                @error('name')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="start_period">{{ __('Start Period') }}</label>
                                                <input type="date" name="start_period" id="start_period"
                                                    class="form-control"
                                                    value="{{ old('start_period', $organization->start_period) }}"
                                                    required>
                                                @error('start_period')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="end_period">{{ __('End Period') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="is_end" id="is_end"
                                                                @if (old('is_end') == true || $organization->end_period) checked @endif>
                                                        </div>
                                                    </div>
                                                    <input type="date" name="end_period" id="end_period"
                                                        class="form-control"
                                                        value="{{ old('end_period', $organization->end_period) }}">
                                                </div>
                                                @error('end_period')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @error('is_end')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description">{{ __('Description') }}</label>
                                                <textarea class="summernote" name="description" required>{{ old('description', $organization->description) }}</textarea>
                                                @error('description')
                                                    <div class="small text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                                {{ __('Update Oganization') }}
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
    </script>
@endpush
