<div class="tab-pane fade" id="custom-v-pills-stripe" role="tabpanel" aria-labelledby="custom-v-pills-stripe-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Stripe Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="stripe_status" checked="">
                                <label class="form-check-label" for="stripe_status">Enable Stripe for Online
                                    Purchases</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label for="stripe_environment" class="form-label">Stripe Environment</label>
                            <select class="form-select @error('stripe_environment') is-invalid @enderror"
                                name="stripe_environment" id="stripe_environment" required>
                                <option value="">Select Stripe Environment</option>
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
                            <label class="form-label">Publishable Key</label>
                            <input type="text" class="form-control @error('api_key') is-invalid @enderror"
                                name="api_key" value="{{ old('api_key') ? old('api_key') : '' }}" id="api_key"
                                placeholder="Enter Publishable Key">
                            <p class="text-muted">Enter the publishable key provided by Stripe for secure client-side integration.
                            </p>
                            @error('api_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Secret Key</label>
                            <input type="text" class="form-control @error('client_secret') is-invalid @enderror"
                                name="client_secret" value="{{ old('client_secret') ? old('client_secret') : '' }}"
                                id="client_secret" placeholder="Enter Client Secret">
                            <p class="text-muted">Provide the secret key from your Stripe account for server-side authentication.
                            </p>
                            @error('client_secret')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                name="currency" value="{{ old('currency') ? old('currency') : '' }}"
                                id="currency" placeholder="Enter currency">
                            <p class="text-muted">Select the currency to process transactions (e.g., USD, EUR, GBP)..
                            </p>
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
