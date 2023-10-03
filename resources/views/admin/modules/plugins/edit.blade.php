@extends('admin.layouts.main')
@section('title')
    @lang('translation.plugins')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.plugins')
        @endslot
        @slot('title')
            Manage Plugins
        @endslot
    @endcomponent
    <form id="plugin-form" action="{{ route('admin.plugins.update') }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Plugin Information <span class="float-end">
                                <a href="{{ route('admin.plugins.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Plugins </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="plugin_type" class="form-label">Plugin Type</label>
                                    <select class="form-select @error('plugin_type_id') is-invalid @enderror"
                                        name="plugin_type_id" id="plugin_type" required>
                                        <option value="">Select Plugin Type</option>
                                        <option value="type1">Type 1</option>
                                        <option value="type2">Type 2</option>
                                    </select>
                                    @error('plugin_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $plugin?->name }}" id="name"
                                        placeholder="Enter name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" id="image" accept="image/*" />
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Documentation</label>
                                    <input type="file" class="form-control @error('documentation') is-invalid @enderror"
                                        name="documentation" value="{{ old('documentation') ?? '' }}" id="documentation"
                                        accept="image/*" />
                                    @error('documentation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="video-url">Video URL</label>
                                    <input type="text" class="form-control @error('video') is-invalid @enderror"
                                        name="video" value="{{ $plugin?->video }}" id="video-url"
                                        placeholder="Enter video url" />
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Version</label>
                                    <input type="text" class="form-control @error('version') is-invalid @enderror"
                                        name="version" value="{{ $plugin?->version }}" id="version"
                                        placeholder="Enter version" />
                                    @error('version')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Enter description">{{ $plugin?->description }}</textarea>
                                    @error('description')
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
                        <h5 class="card-title mb-0">Plugin Basic Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select @error('is_paid') is-invalid @enderror" name="is_paid"
                                    id="payment_status" required>
                                    <option value="">Select Payment Status</option>
                                    <option value="1" @selected($plugin?->is_paid == 1)>Paid</option>
                                    <option value="0" @selected($plugin?->is_paid == 0)>Unpaid</option>
                                </select>
                                @error('is_paid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="plugin-status" class="form-label">Plugin Status</label>
                                <select class="form-select @error('active') is-invalid @enderror" name="active"
                                    id="plugin-status" required>
                                    <option value="">Select Plugin Status</option>
                                    <option value="1" @selected($plugin?->active == 1)>Active</option>
                                    <option value="0" @selected($plugin?->active == 0)>Inactive</option>
                                </select>
                                @error('active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="featured" name="featured" @checked($plugin?->featured)/>
                                    <label class="form-check-label" for="featured">Featured ?</label>
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
    <script>
        $().ready(function() {
            $("#plugin-form").validate({
                rules: {
                    plugin_type_id: "required",
                    name: "required",
                    description: "required",
                    is_paid: "required",
                    active: "required",
                },
                messages: {
                    plugin_type_id: "Please select the plugin type",
                    name: "Please enter the name",
                    description: "Please enter the description",
                    is_paid: "Please select payment status of plugin",
                    active: "Please select status of plugin",
                }
            });
        });
    </script>
@endpush
