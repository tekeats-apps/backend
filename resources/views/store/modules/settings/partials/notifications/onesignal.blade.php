<div class="tab-pane fade active show" id="custom-v-pills-paypal" role="tabpanel"
    aria-labelledby="custom-v-pills-paypal-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Onesignal Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="paypal_status" checked="">
                                <label class="form-check-label" for="paypal_status">Enable Onesignal for notifications</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label for="onesignal_environment" class="form-label">Onesignal Environment</label>
                            <select class="form-select @error('onesignal_environment') is-invalid @enderror"
                                name="onesignal_environment" id="onesignal_environment" required>
                                <option value="">Select Onesignal Environment</option>
                                <option value="development" selected>Development - Sandbox</option>
                                <option value="production">Production</option>
                            </select>
                            <p class="text-muted">Select "Production" for real notifications or "Sandbox" for testing
                                notifications.
                            </p>
                            @error('timezone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">App ID</label>
                            <input type="text" class="form-control @error('app_id') is-invalid @enderror"
                                name="app_id" value="{{ old('app_id') ? old('app_id') : '' }}" id="app_id"
                                placeholder="Enter App ID">
                            <p class="text-muted">The unique identifier for your OneSignal application.
                            </p>
                            @error('app_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Rest API Key</label>
                            <input type="text" class="form-control @error('rest_api_key') is-invalid @enderror"
                                name="rest_api_key" value="{{ old('rest_api_key') ? old('rest_api_key') : '' }}"
                                id="rest_api_key" placeholder="Enter Rest API Key">
                            <p class="text-muted">The API key used for authentication and authorization with OneSignal.
                            </p>
                            @error('rest_api_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
