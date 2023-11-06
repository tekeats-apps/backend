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
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                        name="customer_name" value="{{ old('customer_name') ? old('customer_name') : '' }}"
                                        id="customer_name" placeholder="Enter customer name" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Store/Restaurant Name</label>
                                    <input type="text" class="form-control @error('store_name') is-invalid @enderror"
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
                                        <input type="text" class="form-control @error('domain') is-invalid @enderror"
                                            name="domain" id="domain" placeholder="Enter subdomain name"
                                            value="{{ old('domain') ? old('domain') : '' }}"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2">.{{ env('TENANT_DOMAIN') }}</span>
                                    </div>
                                    @error('domain')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Basic Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="plan_id" class="form-label">Choose Plan</label>
                                <select class="form-select @error('plan_id') is-invalid @enderror" name="plan_id"
                                    id="plan_id" required>
                                    <option value="">Select Plan</option>
                                    @isset($plans)
                                        @foreach ($plans as $key => $plan)
                                            <option value="{{ $key }}">{{ $plan }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select @error('payment_status') is-invalid @enderror"
                                    name="payment_status" id="payment_status" required>
                                    <option value="">Select Payment Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                    <option value="failed">Failed</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status"
                                    id="order_status" required>
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

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Store Authentication <span class="float-end"></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="form-icon right">
                                        <input type="email" id="email" autocomplete="off"
                                            class="form-control form-control-icon @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') ? old('email') : '' }}"
                                            placeholder="Enter email address" required>
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Login Password</label>
                                    <input type="password"
                                        class="form-control @error('login_password') is-invalid @enderror"
                                        name="login_password"
                                        value="{{ old('login_password') ? old('login_password') : '' }}"
                                        placeholder="Enter strong password to access store portal" required
                                        autocomplete="off">
                                    @error('login_password')
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
                    login_password: {
                        required: true
                    },
                    domain: {
                        required: true
                    }
                },
                messages: {
                    customer_name: "Please enter customer name",
                    store_name: "Please enter store or restaurant name",
                    email: "Please enter a valid email address",
                    domain: "Please enter domain for store or restaurant",
                    status: "Please select status of store",
                    payment_status: "Please select payment status of order",
                }
            });
        });
    </script>
@endpush
