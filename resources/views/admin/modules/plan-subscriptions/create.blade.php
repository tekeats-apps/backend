@extends('admin.layouts.main')
@section('title')
    Subscription Plans
@endsection
@section('on-top-css')
    <!--select2 cdn-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Subscription Plans
        @endslot
        @slot('title')
            Create Plan
        @endslot
    @endcomponent
    <form id="plan-subscription-form" action="{{ route('admin.plans.subscriptions.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Plan Information <span class="float-end">
                                <a href="{{ route('admin.plans.subscriptions.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Subscription Plans </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Tag</label>
                                    <input type="text" class="form-control @error('tag') is-invalid @enderror"
                                        name="tag" value="{{ old('tag') ?? '' }}" id="tag"
                                        placeholder="Enter plan tag e.g basic, pro" required>
                                    @error('tag')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') ?? '' }}" id="name"
                                        placeholder="Enter plan name e.g Basic Plan" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Enter plan description" id="description">{{ old('description') ?? '' }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="invoice_interval" class="form-label required">Invoice Interval</label>
                                <select class="form-select @error('invoice_interval') is-invalid @enderror"
                                    name="invoice_interval" id="invoice_interval" required>
                                    <option value="">Select Interval</option>
                                    <option value="year">Year</option>
                                    <option value="month">Month</option>
                                </select>
                                @error('invoice_interval')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Invoice Period</label>
                                    <input type="number" min="0"
                                        class="form-control @error('invoice_period') is-invalid @enderror"
                                        name="invoice_period" value="{{ old('invoice_period') ?? '' }}" id="invoice_period"
                                        placeholder="Enter invoice period e.g 1" required>
                                    @error('invoice_period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="trial_interval" class="form-label">Trail Interval</label>
                                <select class="form-select @error('trial_interval') is-invalid @enderror"
                                    name="trial_interval" id="trial_interval" required>
                                    <option value="">Select Trail Interval</option>
                                    <option value="day">Day</option>
                                    <option value="month">Month</option>
                                </select>
                                @error('trial_interval')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Trail Period</label>
                                    <input type="number" min="0"
                                        class="form-control @error('trial_period') is-invalid @enderror" name="trial_period"
                                        value="{{ old('trial_period') ?? '' }}" id="trial_period"
                                        placeholder="Enter invoice period e.g 7" required>
                                    @error('trial_period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="grace_interval" class="form-label">Grace Interval</label>
                                <select class="form-select @error('grace_interval') is-invalid @enderror"
                                    name="grace_interval" id="grace_interval" required>
                                    <option value="">Select Trail Interval</option>
                                    <option value="day">Day</option>
                                    <option value="month">Month</option>
                                </select>
                                @error('grace_interval')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Grace Period</label>
                                    <input type="number" min="0"
                                        class="form-control @error('grace_period') is-invalid @enderror"
                                        name="grace_period" value="{{ old('grace_period') ?? '' }}" id="grace_period"
                                        placeholder="Enter grace period e.g 7" required>
                                    @error('grace_period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" min="0" step="0.01" value="{{ old('price') ?? '' }}" id="price"
                                        placeholder="Enter price" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            $("#plan-subscription-form").validate({
                rules: {
                    name: "required",
                    duration: "required",
                    price: "required",
                    description: "required",
                },
                messages: {
                    name: "Please enter the name",
                    duration: "Please enter duration",
                    price: "Please enter price",
                    description: "Please enter the description",
                }
            });
        });

        // initialize select2
        $(document).ready(function() {
            $('.select-multiple').select2({
                placeholder: "Select a feature",
            });
            var data = [{
                    id: 0,
                    text: 'enhancement'
                },
                {
                    id: 1,
                    text: 'bug'
                },
                {
                    id: 2,
                    text: 'duplicate'
                },
                {
                    id: 3,
                    text: 'invalid'
                },
                {
                    id: 4,
                    text: 'wontfix'
                }
            ];
        });
    </script>
@endpush
