<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="image">{{ __('Application Logo') }}</label>
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                <input type="file" name="app_logo" id="image-upload" accept="image/*" required />
                                @error('app_logo')
                                    <div class="small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Application Favicon') }}</label>
                            <div id="image-preview-2" class="image-preview">
                                <label for="image-upload-2" id="image-label-2">{{ __('Choose File') }}</label>
                                <input type="file" name="app_favicon" id="image-upload-2" accept="image/*"
                                    required />
                                @error('app_favicon')
                                    <div class="small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="app_name">{{ __('Application Name') }}</label>
                                    <input type="text" class="form-control">
                                    @error('app_name')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="app_abb_name">{{ __('Application Abbreviation Name') }}</label>
                                    <input type="text" class="form-control">
                                    @error('app_abb_name')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
