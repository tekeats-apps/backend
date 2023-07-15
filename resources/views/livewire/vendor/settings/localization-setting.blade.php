<div>
    @include('plugins.alerts.alerts')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localization Settings</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <fieldset>
                            <h6> Language Setting</h6>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">System Languages</label>
                                    <select class="form-control  @error('languages') is-invalid @enderror"
                                        data-placeholder="Select languages for system" multiple
                                        wire:model.defer='languages'>
                                        @isset($allowedLanguages)
                                            @foreach ($allowedLanguages as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('languages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Default Languages</label>
                                    <select class="form-control  @error('default_language') is-invalid @enderror"
                                        wire:model.defer="default_language">
                                        <option value="en" selected>English</option>
                                        <option value="fr">French</option>
                                        <option value="de">Germany</option>
                                    </select>
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
                                    <select class="form-control  @error('timezone') is-invalid @enderror"
                                        wire:model.defer="timezone">
                                        @isset($allowedTimezones)
                                            @foreach ($allowedTimezones as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    </p>
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Date Format</label>
                                    <select class="form-control  @error('date_format') is-invalid @enderror"
                                        wire:model.defer="date_format">
                                        @isset($allowedDateFormats)
                                            @foreach ($allowedDateFormats as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    </p>
                                    @error('date_format')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Time Format</label>
                                    <select class="form-control  @error('time_format') is-invalid @enderror"
                                        wire:model.defer="time_format">
                                        @isset($allowedTimeFormats)
                                            @foreach ($allowedTimeFormats as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
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
                                    <select class="form-control  @error('currency') is-invalid @enderror"
                                        wire:model.defer='currency' wire:change="updateCurrencySymbol">
                                        @isset($allowedCurrencies)
                                            @foreach ($allowedCurrencies as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <p class="text-muted">Select your restaurant currency for display and ordering.
                                    </p>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Currency Symbol</label>
                                    <input type="text"
                                        class="form-control @error('currency_symbol') is-invalid @enderror" read-only
                                        wire:model.defer='currency_symbol' />
                                    <p class="text-muted">Select your restaurnt currency symbol to show.
                                    </p>
                                    @error('currency_symbol')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Currency Position</label>
                                    <select class="form-control  @error('currency_position') is-invalid @enderror"
                                        wire:model.defer="currency_position">
                                        <option value="left" selected>Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                    @error('currency_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
