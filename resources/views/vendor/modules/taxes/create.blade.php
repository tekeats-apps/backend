@extends('vendor.layouts.main')

@section('on-top-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@push('css')
    @include('plugins.sweetalert2.css')
@endpush
@section('title', 'Taxes')
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Taxes
        @endslot
        @slot('title')
            Add New Tax
        @endslot
    @endcomponent

    <form id="tax-form" action="{{ route('vendor.taxes.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tax Information<span class="float-end">
                                        <a href="{{ route('vendor.taxes.list') }}" class="btn btn-info bt-sm">Back to
                                            Taxes</a>
                                    </span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{ old('title') }}" placeholder="Enter tax title"
                                                required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="number" min="0" step="0.01"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                value="{{ old('amount') }}" placeholder="Enter amount" required>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <label for="description-field" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description-field"
                                            rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <label for="plugin_type" class="form-label">Type</label>
                                            <select class="form-select @error('type') is-invalid @enderror" name="type"
                                                id="plugin_type" required>
                                                <option value="">Select Tax Type</option>
                                                @isset($taxTypes)
                                                    @foreach ($taxTypes as $taxType)
                                                        <option value="{{ $taxType?->value }}">{{ ucfirst($taxType?->value) }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
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

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Apply Tax On</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6 class="fw-semibold">Categories</h6>
                                        <select class="js-example-basic-multiple" name="categories[]" multiple="multiple">
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category?->id }}">{{ $category?->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="fw-semibold">Products</h6>
                                        <select class="js-example-basic-multiple" name="products[]" multiple="multiple">
                                            @isset($products)
                                                @foreach ($products as $product)
                                                <option value="{{ $product?->id }}">{{ $product?->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
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
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#tax-form").validate({
                rules: {
                    title: "required",
                    type: "required",
                    amount: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    title: "Please enter a tax title",
                    type: "Please select a tax type.",
                    amount: {
                        required: "Please enter an amount.",
                        number: "The amount must be a valid number.",
                        min: "The amount must be 0 or more."
                    }
                }
            });

        });
    </script>
@endpush
