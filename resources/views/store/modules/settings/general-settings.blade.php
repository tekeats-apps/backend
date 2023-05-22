@extends('store.layouts.main')
@push('css')
    @include('store.layouts.components.plugins.filepond.css');
@endpush
@section('title')
    @lang('translation.users')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('store.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-info">
                            <h5 class="card-title mb-0">Business Information </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant Name</label>
                                        <input type="text" class="form-control @error('store_name') is-invalid @enderror"
                                            name="store_name" value="{{ old('store_name') ? old('store_name') : '' }}"
                                            id="store_name" placeholder="Enter your restaurant name">
                                        @error('store_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant Email</label>
                                        <input type="text"
                                            class="form-control @error('store_email') is-invalid @enderror"
                                            name="store_email" value="{{ old('store_email') ? old('store_email') : '' }}"
                                            id="store_email" placeholder="Enter your restaurant email address">
                                        @error('store_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Restaurant Phone</label>
                                        <input type="text"
                                            class="form-control @error('store_phone') is-invalid @enderror"
                                            name="store_phone" value="{{ old('store_phone') ? old('store_phone') : '' }}"
                                            id="store_phone" placeholder="Enter your restaurant phone number">
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-info">
                            <h5 class="card-title mb-0">Restaurant Address </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mb-2">
                                    <!-- Base Example -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                        <label class="form-check-label" for="formCheck1">
                                            Enable Google Maps Location Search
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') ? old('address') : '' }}" id="address"
                                            placeholder="Enter your restaurant address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Adress II</label>
                                        <input type="text"
                                            class="form-control @error('store_email') is-invalid @enderror"
                                            name="store_email" value="{{ old('store_email') ? old('store_email') : '' }}"
                                            id="store_email" placeholder="Floor, Appartment or suite etc.">
                                        @error('store_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text"
                                            class="form-control @error('store_phone') is-invalid @enderror"
                                            name="store_phone" value="{{ old('store_phone') ? old('store_phone') : '' }}"
                                            id="store_phone" placeholder="Enter your restaurant phone number">
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text"
                                            class="form-control @error('store_phone') is-invalid @enderror"
                                            name="store_phone" value="{{ old('store_phone') ? old('store_phone') : '' }}"
                                            id="store_phone" placeholder="Enter your restaurant phone number">
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text"
                                            class="form-control @error('store_phone') is-invalid @enderror"
                                            name="store_phone" value="{{ old('store_phone') ? old('store_phone') : '' }}"
                                            id="store_phone" placeholder="Enter your restaurant phone number">
                                        @error('store_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') ? old('address') : '' }}" id="address"
                                            placeholder="Enter your restaurant address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text"
                                            class="form-control @error('store_email') is-invalid @enderror"
                                            name="store_email" value="{{ old('store_email') ? old('store_email') : '' }}"
                                            id="store_email" placeholder="Floor, Appartment or suite etc.">
                                        @error('store_email')
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
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-success">
                            <h5 class="card-title mb-0">Localization</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="system_languages" class="form-label">System Languages</label>
                                    <select class="form-select @error('system_languages') is-invalid @enderror"
                                        name="system_languages" id="system_languages" multiple>
                                        <option value="">Select Languages</option>
                                        <option value="en">English</option>
                                        <option value="ar">Arabic</option>
                                        <option value="de">German</option>
                                    </select>
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="default_language" class="form-label">Default Language</label>
                                    <select class="form-select @error('default_language') is-invalid @enderror"
                                        name="default_language" id="default_language" required>
                                        <option value="">Select Default Language</option>
                                    </select>
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="timezone" class="form-label">Timezone</label>
                                    <select class="form-select @error('timezone') is-invalid @enderror" name="timezone"
                                        id="timezone" required>
                                        <option value="">Select Timezone</option>
                                    </select>
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="time_format" class="form-label">Time Format</label>
                                    <select class="form-select @error('time_format') is-invalid @enderror"
                                        name="time_format" id="time_format" required>
                                        <option value="">Select Time Format</option>
                                    </select>
                                    @error('time_format')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="date_format" class="form-label">Date Format</label>
                                    <select class="form-select @error('date_format') is-invalid @enderror"
                                        name="date_format" id="date_format" required>
                                        <option value="">Select Date Format</option>
                                    </select>
                                    @error('time_format')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="date_time_format" class="form-label">Date & Time Format</label>
                                    <select class="form-select @error('date_time_format') is-invalid @enderror"
                                        name="date_time_format" id="date_time_format" required>
                                        <option value="">Select Date & Time Format</option>
                                    </select>
                                    @error('time_format')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-primary">
                            <h5 class="card-title mb-0">Currency Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Currency</label>
                                    <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                        name="currency" value="{{ old('currency') ? old('currency') : '' }}"
                                        id="currency" placeholder="Enter you restaurant currency eg. USD" required>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Currency Symbol</label>
                                    <input type="text"
                                        class="form-control @error('currency_symbol') is-invalid @enderror"
                                        name="currency_symbol"
                                        value="{{ old('currency_symbol') ? old('currency_symbol') : '' }}"
                                        id="currency_symbol" placeholder="Enter you restaurant currency symbol eg. $"
                                        required>
                                    @error('currency_symbol')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="currency_position" class="form-label">Currency Position</label>
                                    <select class="form-select @error('currency_position') is-invalid @enderror"
                                        name="currency_position" id="currency_position" required>
                                        <option value="">Select currency position</option>
                                        <option value="right">Right</option>
                                        <option value="left">Left</option>
                                    </select>
                                    @error('currency_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
