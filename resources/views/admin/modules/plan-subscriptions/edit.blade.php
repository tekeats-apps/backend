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
            Edit Subscription Plan
        @endslot
    @endcomponent
    <form id="plan-subscription-form" action="{{ route('admin.plans.subscriptions.update', $planSubscription?->id) }}"
        method="POST" autocomplete="off">
        @csrf @method('PUT')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Subscription Plan Information <span class="float-end">
                                <a href="{{ route('admin.plans.subscriptions.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Subscription Plans </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Plan Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $planSubscription?->name }}" id="name"
                                        placeholder="Enter plan name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="duration" class="form-label required">Duration</label>
                                <select class="form-select @error('duration') is-invalid @enderror" name="duration"
                                    id="duration" required>
                                    <option value="">Select Duration Type</option>
                                    <option value="Yearly" @selected($planSubscription?->duration === 'Yearly')>Yearly</option>
                                    <option value="Monthly" @selected($planSubscription?->duration === 'Monthly')>Monthly</option>
                                </select>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ $planSubscription?->price }}" id="price"
                                        placeholder="Enter price" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Discount</label>
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                        name="discount" value="{{ $planSubscription?->discount }}" id="discount"
                                        placeholder="Enter discount" />
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Trial Period</label>
                                    <input type="text"
                                        class="form-control @error('trial_period_days') is-invalid @enderror"
                                        name="trial_period_days" value="{{ $planSubscription?->trial_period_days }}"
                                        id="trial_period_days" placeholder="Enter trial period days" />
                                    @error('trial_period_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="duration" class="form-label">Features</label>
                                <select class="select-multiple" name="features[]" multiple="multiple">
                                    @isset($planFeatures)
                                        @foreach ($planFeatures as $key => $planFeature)
                                            <option value="{{ $planFeature?->id }}" @selected($planFeature?->id == isset($planSubscription?->planFeatures[$key]['id']))>
                                                {{ $planFeature?->feature_name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label required">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Enter plan description" id="description">{{ $planSubscription?->description }}</textarea>
                                    @error('description')
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
