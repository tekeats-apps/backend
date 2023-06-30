<div class="tab-pane fade active show" id="custom-v-pills-s3_bucket" role="tabpanel"
    aria-labelledby="custom-v-pills-s3_bucket-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">AWS S3 Bucket Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="s3_bucket_status" checked="">
                                <label class="form-check-label" for="s3_bucket_status">Enable S3 Bucket for Storage</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Access Key ID</label>
                            <input type="text" class="form-control @error('access_key_id') is-invalid @enderror"
                                name="access_key_id" value="{{ old('access_key_id') ? old('access_key_id') : '' }}" id="access_key_id"
                                placeholder="Enter aws access key ID">
                            <p class="text-muted">Enter your AWS Access Key ID.
                            </p>
                            @error('access_key_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Secret Access Key</label>
                            <input type="text" class="form-control @error('secret_access_key') is-invalid @enderror"
                                name="secret_access_key" value="{{ old('secret_access_key') ? old('secret_access_key') : '' }}"
                                id="secret_access_key" placeholder="Enter secret access key">
                            <p class="text-muted">Enter your AWS Secret Access Key.
                            </p>
                            @error('secret_access_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Default Region</label>
                            <input type="text" class="form-control @error('default_region') is-invalid @enderror"
                                name="default_region" value="{{ old('default_region') ? old('default_region') : '' }}"
                                id="default_region" placeholder="Enter you bucket default region for services">
                            <p class="text-muted">Specify the default region for your AWS services.
                            </p>
                            @error('default_region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">S3 Bucket Name</label>
                            <input type="text" class="form-control @error('bucket_name') is-invalid @enderror"
                                name="bucket_name" value="{{ old('bucket_name') ? old('bucket_name') : '' }}"
                                id="bucket_name" placeholder="Enter s3 bucket name">
                            <p class="text-muted">Provide the name of the AWS S3 bucket to be used.
                            </p>
                            @error('bucket_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="path_style" class="form-label">Path Style Endpoint</label>
                                <select class="form-select @error('path_style_endpoint') is-invalid @enderror"
                                    name="path_style_endpoint" id="path_style_endpoint" required>
                                    <option value="1">True</option>
                                    <option value="0" selected>False</option>
                                </select>
                                <p class="text-muted">Set whether to use path-style endpoints (true/false) for AWS S3 operations.
                                </p>
                                @error('path_style_endpoint')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
