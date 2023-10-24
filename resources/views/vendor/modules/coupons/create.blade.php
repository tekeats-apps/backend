@extends('vendor.layouts.main')

@push('css')
    @include('plugins.sweetalert2.css')
@endpush

@section('title', 'Coupons')

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Coupons
        @endslot
        @slot('title')
            Add New Coupon
        @endslot
    @endcomponent

    <form id="coupon-form" action="{{ route('vendor.coupons.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Coupon Information<span class="float-end">
                                        <a href="{{ route('vendor.coupons.list') }}" class="btn btn-info bt-sm">Back to
                                            Coupons</a>
                                    </span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="coupon-code" class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label required">Coupon Code</label>
                                            <input type="text"
                                                class="form-control @error('coupon_code') is-invalid @enderror"
                                                name="coupon_code" value="{{ old('coupon_code') }}"
                                                placeholder="Enter tax coupon code" required>
                                            @error('coupon_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label required">Amount</label>
                                            <input type="number" min="0" step="0.01"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                value="{{ old('amount') }}" placeholder="Enter amount" required>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                name="start_date" value="{{ old('start_date') }}"
                                                placeholder="Enter coupon start date">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="date"
                                                class="form-control @error('expiry_date') is-invalid @enderror"
                                                name="expiry_date" value="{{ old('expiry_date') }}"
                                                placeholder="Enter coupon expiry date">
                                            @error('expiry_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-2">
                                        <label for="coupon_description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="coupon_description"
                                            placeholder="Enter coupon description" rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Options</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="mb-3">
                                            <label for="amount_type" class="form-label required">Coupon Amount Type</label>
                                            <select class="form-select @error('amount_type') is-invalid @enderror"
                                                name="amount_type" id="amount_type" required>
                                                <option value="">Select Coupon Amount Type</option>
                                                @isset($couponAmountTypes)
                                                    @foreach ($couponAmountTypes as $couponAmountType)
                                                        <option value="{{ $couponAmountType->value }}">
                                                            {{ ucfirst($couponAmountType->value) }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('amount_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Allowed Time <i class="ri ri-information-fill text-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"  data-bs-content="Please input the number of times the coupon can be used, or alternatively, select the 'unlimited' option if you wish to utilize it an unlimited number of times."></i></label>
                                            <input type="number" min="0" step="0.01"
                                                class="form-control @error('allowed_time') is-invalid @enderror"
                                                name="allowed_time" id="allowed_time" value="{{ old('allowed_time') }}"
                                                placeholder="Enter allowed time">
                                            @error('allowed_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-lg-flex align-items-center">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_unlimited"
                                                    name="is_unlimited" value="1" />
                                                <label class="form-check-label" for="is_unlimited">Unlimited ?</label>
                                            </div>
                                            @error('is_unlimited')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-check form-switch form-switch-lg form-switch-success">
                                                <input class="form-check-input @error('active') is-invalid @enderror"
                                                    type="checkbox" name="active" id="active" value="1"
                                                    {{ old('active') }}>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            @error('active')
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
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#coupon-form").validate({
                rules: {
                    coupon_code: "required",
                    amount: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    amount_type: "required"
                },
                messages: {
                    coupon_code: "Please enter a coupon code",
                    amount: {
                        required: "Please enter an amount.",
                        number: "The amount or precentage must be a valid number.",
                        min: "The amount or precentage must be 0 or more."
                    },
                    amount_type: "Please select an amount type."
                }
            });


            let isUnlimitedIsChecked = $('#is_unlimited').is(':checked');
            let allowedTime = $('#allowed_time');

            /**
             * check on document ready if option "is_unlimited" is
             * checked then disabled "allowed time" fied.
             */
            if (isUnlimitedIsChecked) {
                allowedTime.prop("disabled", true);
                allowedTime.val('');
            } else {
                allowedTime.prop("disabled", false);
            }

            /**
             * check if option "is_unlimited" is checked then
             * disabled "allowed time" fied.
             */
            $('#is_unlimited').change(function() {
                let isChecked = $(this).is(':checked');

                if (isChecked) {
                    allowedTime.prop("disabled", true);
                    allowedTime.val('');
                } else {
                    allowedTime.prop("disabled", false);
                }
            });
        });
    </script>
@endpush
