<div class="tab-pane fade active show" id="custom-v-pills-paypal" role="tabpanel"
    aria-labelledby="custom-v-pills-paypal-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">PayPal Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="paypal_status" checked="">
                                <label class="form-check-label" for="paypal_status">Enable PayPal for Online Purchases</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label for="paypal_environment" class="form-label">PayPal Environment</label>
                            <select class="form-select @error('paypal_environment') is-invalid @enderror"
                                name="paypal_environment" id="paypal_environment" required>
                                <option value="">Select PayPal Environment</option>
                                <option value="development" selected>Development - Sandbox</option>
                                <option value="production">Production</option>
                            </select>
                            <p class="text-muted">Select "Production" for real transactions or "Sandbox" for testing
                                transactions.
                            </p>
                            @error('timezone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Client ID</label>
                            <input type="text" class="form-control @error('client_id') is-invalid @enderror"
                                name="client_id" value="{{ old('client_id') ? old('client_id') : '' }}" id="client_id"
                                placeholder="Enter Client ID">
                            <p class="text-muted">Enter the Client ID from your PayPal Developer account for secure
                                authentication.
                            </p>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Client Secret</label>
                            <input type="text" class="form-control @error('client_secret') is-invalid @enderror"
                                name="client_secret" value="{{ old('client_secret') ? old('client_secret') : '' }}"
                                id="client_secret" placeholder="Enter Client Secret">
                            <p class="text-muted">Enter the Client Secret from your PayPal Developer account to ensure
                                integration integrity.
                            </p>
                            @error('client_secret')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
