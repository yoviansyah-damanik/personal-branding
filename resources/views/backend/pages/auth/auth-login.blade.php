@extends('backend.layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend-assets/library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login.do') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="username">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control" value="{{ old('username') }}" name="username"
                        tabindex="1" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">{{ __('Password') }}</label>
                        {{-- <div class="float-right">
                            <a href="auth-forgot-password.html" class="text-small">
                                Forgot Password?
                            </a>
                        </div> --}}
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
            {{-- <div class="mt-4 mb-3 text-center">
                <div class="text-job text-muted">Login With Social</div>
            </div>
            <div class="row sm-gutters">
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                        <span class="fab fa-facebook"></span> Facebook
                    </a>
                </div>
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                        <span class="fab fa-twitter"></span> Twitter
                    </a>
                </div>
            </div> --}}

        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
