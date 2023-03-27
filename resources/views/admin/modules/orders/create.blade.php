@extends('admin.layouts.main')
@section('title')
    @lang('translation.orders')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.orders')
        @endslot
        @slot('title')
            @lang('translation.manage-orders')
        @endslot
    @endcomponent

    <form id="order-form" action="{{ route('admin.order.store') }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Information <span class="float-end">
                                <a href="{{ route('admin.order.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Orders </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Customer Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('customer_name') ? ' is-invalid' : '' }}"
                                        name="customer_name" value="{{ old('customer_name') ? old('customer_name') : '' }}"
                                        id="customer_name" placeholder="Enter customer name" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('customer_email') ? ' is-invalid' : '' }}" name="customer_email"
                                        value="{{ old('customer_email') ? old('customer_email') : '' }}" placeholder="Enter customer email"
                                        required>
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Store/Restaurant Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('store_name') ? ' is-invalid' : '' }}"
                                        name="store_name" value="{{ old('store_name') ? old('store_name') : '' }}"
                                        id="store_name" placeholder="Enter store or restaurant name" required>
                                    @error('store_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Subdomain</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control {{ $errors->has('domain') ? ' is-invalid' : '' }}"
                                            name="domain" id="domain" placeholder="Enter subdomain name"
                                            value="{{ old('domain') ? old('domain') : '' }}"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2">.{{ request()->getHost() }}</span>
                                    </div>
                                    @error('domain')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Basic Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select required" name="payment_status" id="payment_status" data-choices
                                data-choices-search-false required>
                                <option value="" selected>Select Payment Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select required" name="status" id="status" data-choices
                                data-choices-search-false required>
                                <option value="">Select Order Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="expired">Expired</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
    </form>
@endsection
@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            $("#order-form").validate({
                rules: {
                    customer_name: "required",
                    store_name: "required",
                    status: "required",
                    payment_status: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    domain: {
                        required: true
                    }
                },
                messages: {
                    customer_name: "Please enter customer name",
                    store_name: "Please enter store or restaurant name",
                    email: "Please enter customer email address",
                    domain: "Please enter domain for store or restaurant",
                    status: "Please select status of store",
                    payment_status: "Please select payment status of order",
                }
            });
        });
    </script>
@endpush
