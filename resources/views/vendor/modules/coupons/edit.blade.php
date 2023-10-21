@extends('vendor.layouts.main')

@push('css')
    @include('plugins.sweetalert2.css')
    @include('plugins.flatpicker.css')
@endpush

@section('title', 'Coupons')

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Coupons
        @endslot
        @slot('title')
            Edit Coupon
        @endslot
    @endcomponent

    <form id="coupon-form" action="{{ route('vendor.coupons.update', $coupon?->id) }}" method="POST" autocomplete="off">
        @csrf @method('PUT')

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
                                    <div class="col-lg-12 mb-2 d-flex">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="coupon_option"
                                                id="option_automatic" value="automatic" @checked($coupon?->coupon_option->value == 'automatic')>
                                            <label class="form-check-label" for="option_automatic">
                                                Automatic
                                            </label>
                                        </div>
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="coupon_option"
                                                id="option_manual" value="manual" @checked($coupon?->coupon_option->value == 'manual')>
                                            <label class="form-check-label" for="option_manual">
                                                Manual
                                            </label>
                                        </div>
                                    </div>

                                    <div id="coupon-code" class="col-lg-6 mb-2 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Coupon Code</label>
                                            <input type="text"
                                                class="form-control @error('coupon_code') is-invalid @enderror"
                                                name="coupon_code" value="{{ $coupon?->coupon_code }}"
                                                placeholder="Enter tax coupon code" required>
                                            @error('coupon_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="number" min="0" step="0.01"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                value="{{ $coupon?->amount }}" placeholder="Enter amount" required>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="date"
                                                class="form-control @error('expiry_date') is-invalid @enderror"
                                                name="expiry_date" value="{{ $coupon?->getRawOriginal('expiry_date') }}"
                                                placeholder="Enter coupon expiry date" required>
                                            @error('expiry_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-6 mb-2">
                                        <div>
                                            <label class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" name="expiry_date"
                                                placeholder="Select expiry date" data-provider="flatpickr"
                                                data-date-format="d M, Y">
                                            @error('expiry_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
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
                                            <label for="plugin_type" class="form-label">Coupon Type</label>
                                            <select class="form-select @error('type') is-invalid @enderror" name="type"
                                                id="plugin_type" required>
                                                <option value="">Select Coupon Type</option>
                                                @isset($couponTypes)
                                                    @foreach ($couponTypes as $couponType)
                                                        <option value="{{ $couponType->value }}" @selected($couponType?->value == $coupon?->type->value)>
                                                            {{ ucfirst($couponType->value) }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="mb-3">
                                            <label for="amount_type" class="form-label">Coupon Amount Type</label>
                                            <select class="form-select @error('amount_type') is-invalid @enderror"
                                                name="amount_type" id="amount_type" required>
                                                <option value="">Select Coupon Amount Type</option>
                                                @isset($couponAmountTypes)
                                                    @foreach ($couponAmountTypes as $couponAmountType)
                                                        <option value="{{ $couponAmountType?->value }}" @selected($couponAmountType?->value == $coupon?->amount_type->value)>
                                                            {{ ucfirst($couponAmountType?->value) }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('amount_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input class="form-check-input @error('active') is-invalid @enderror"
                                                type="checkbox" name="active" id="active" value="1"
                                                @checked($coupon?->active)>
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
    </form>
@endsection

@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    @include('plugins.flatpicker.js')
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#coupon-form").validate({
                rules: {
                    coupon_option: "required",
                    type: "required",
                    amount: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    amount_type: "required"
                },
                messages: {
                    coupon_option: "Please select a coupon option",
                    type: "Please select a coupon type.",
                    amount: {
                        required: "Please enter an amount or percentage.",
                        number: "The amount or precentage must be a valid number.",
                        min: "The amount or precentage must be 0 or more."
                    },
                    amount_type: "Please select an amount type."
                }
            });

            /**
             * check if option automatic is checked then do not
             * show coupon code field
             */
            let optionAutomaticIsChecked = $('#option_automatic').is(':checked');
            if (optionAutomaticIsChecked) {
                $('#coupon-code').addClass('d-none');
            } else {
                $('#coupon-code').removeClass('d-none');
            }

            // on check option "automatic" hide coupon code field
            $('#option_automatic').change(function() {
                $('#coupon-code').addClass('d-none');
                this.value = '';
            });

            // on check option "manual" show coupon code field
            $('#option_manual').change(function() {
                $('#coupon-code').removeClass('d-none');
            });
        });
    </script>
@endpush
