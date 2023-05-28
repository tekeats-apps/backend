<div class="tab-pane fade" id="custom-v-pills-localization" role="tabpanel"
    aria-labelledby="custom-v-pills-localization-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localization Settings</h5>
                </div>
                <div class="card-body">
                    <fieldset>
                        <h6> Language Setting</h6>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">System Languages</label>
                                <select class="form-control  @error('languages') is-invalid @enderror"
                                    name="languages[]" multiple="multiple">
                                    <option value="en" selected>English</option>
                                    <option value="fr">French</option>
                                    <option value="de">Germany</option>
                                </select>
                                </p>
                                @error('languages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Default Languages</label>
                                <select class="form-control  @error('default_language') is-invalid @enderror"
                                    name="default_language">
                                    <option value="en" selected>English</option>
                                    <option value="fr">French</option>
                                    <option value="de">Germany</option>
                                </select>
                                </p>
                                @error('default_language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <h6> Time Setting</h6>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Timezone</label>
                                <select class="form-control  @error('timezone') is-invalid @enderror" name="timezone">
                                    <option value="en" selected>Asia/Karachi</option>
                                </select>
                                </p>
                                @error('timezone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Date Format</label>
                                <select class="form-control  @error('date_format') is-invalid @enderror"
                                    name="date_format">
                                    <option value="YYYY-MM-DD" selected>YYYY-MM-DD</option>
                                    <option value="DD-MM-YYYY">DD-MM-YYYY</option>
                                    <option value="MM-DD-YYYY">MM-DD-YYYY</option>
                                </select>
                                </p>
                                @error('date_format')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Time Format</label>
                                <select class="form-control  @error('time_format') is-invalid @enderror"
                                    name="time_format">
                                    <option value="12_hours" selected>12 Hours</option>
                                    <option value="12_hours">24 Hours</option>
                                </select>
                                </p>
                                @error('time_format')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <h6> Currency Setting</h6>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Default Currency</label>
                                <input type="text"
                                    class="form-control @error('currency') is-invalid @enderror"
                                    name="currency"
                                    value="{{ old('currency') ? old('currency') : '' }}"
                                    id="currency" placeholder="USD, PKR .etc">
                                <p class="text-muted">Enter your restaurnt currency for display and ordering.
                                </p>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Currency Symbol</label>
                                <input type="text"
                                    class="form-control @error('currency_symbol') is-invalid @enderror"
                                    name="currency_symbol"
                                    value="{{ old('currency_symbol') ? old('currency_symbol') : '' }}"
                                    id="currency_symbol" placeholder="$, Rs. .etc">
                                <p class="text-muted">Enter your restaurnt currency symbol to show.
                                </p>
                                @error('currency_symbol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Currency Position</label>
                                <select class="form-control  @error('currency_position') is-invalid @enderror"
                                    name="currency_position">
                                    <option value="left" selected>Left</option>
                                    <option value="right">Right</option>
                                </select>
                                @error('currency_position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
