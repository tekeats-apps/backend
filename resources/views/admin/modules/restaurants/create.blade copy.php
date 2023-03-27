@extends('admin.layouts.main')
@section('title')
    @lang('translation.restaurants')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.restaurants')
        @endslot
        @slot('title')
            @lang('translation.manage-restaurants')
        @endslot
    @endcomponent

    <form id="restaurant-form" action="{{route('admin.restaurant.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Restaurant Information <span class="float-end">
                                <a href="{{ route('admin.restaurant.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Restaurants </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') ? old('name') : '' }}" placeholder="Enter name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
                                        value="{{ old('slug') ? old('slug') : '' }}" id="slug" placeholder="Slug base on name"
                                        disabled required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ old('email') ? old('email') : '' }}" placeholder="Enter restaurant email"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                        name="phone_number" value="{{ old('phone_number') ? old('phone_number') : '' }}"
                                        placeholder="Enter restaurant phone number" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Restaurant Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        name="address" id="address" value="{{ old('address') ? old('address') : '' }}"
                                        placeholder="Enter full address" required>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}"
                                        name="country" id="country" value="{{ old('country') ? old('country') : '' }}"
                                        placeholder="Enter country">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"
                                        name="state" id="state" value="{{ old('state') ? old('state') : '' }}"
                                        placeholder="Enter state" required>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" id="city"
                                        name="city" value="{{ old('city') ? old('city') : '' }}"
                                        placeholder="Enter city" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                        name="zip_code" id="zip_code"
                                        value="{{ old('zip_code') ? old('zip_code') : '' }}"
                                        placeholder="Enter zip_code">
                                    @error('zip_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                        name="latitude" id="latitude"
                                        value="{{ old('latitude') ? old('latitude') : '' }}" placeholder="Enter latitude"
                                        disabled>
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                        name="longitude" id="longitude"
                                        value="{{ old('longitude') ? old('longitude') : '' }}"
                                        placeholder="Enter longitude" disabled>
                                    @error('longitude')
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
                        <h5 class="card-title mb-0">Restaurant Basic Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mb-3">
                            <div class="input-group">
                                <input type="text"
                                    class="form-control {{ $errors->has('domain') ? ' is-invalid' : '' }}" name="domain"
                                    id="domain"
                                    placeholder="Enter domain for restaurant (app.{{ request()->getHost() }})">
                                @error('domain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="choices-publish-status-input" data-choices
                                data-choices-search-false>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
    @include('admin.layouts.components.plugins.google.get-address-data-autocomplete')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            $("#restaurant-form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        required: true
                    },
                    slug: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    latitude: {
                        required: true
                    },
                    longitude: {
                        required: true
                    },
                    domain: {
                        required: true
                    }
                },
                messages: {
                    name: "Please enter restaurant name"
                }
            });
        });
    </script>
@endpush
