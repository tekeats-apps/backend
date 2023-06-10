@extends('vendor.layouts.main')
@section('title')
    @lang('translation.roles')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.roles')
        @endslot
        @slot('title')
            @lang('translation.manage-roles')
        @endslot
    @endcomponent

    <form id="roles-form" action="{{ route('vendor.roles.update', $role->id) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Role Information <span class="float-end">
                                <a href="#" class="btn btn-primary btn-label bt-sm waves-effect waves-light"><i
                                        class="ri-folder-lock-line label-icon"></i> Permissions</a>
                                <a href="{{ route('vendor.roles.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Roles </a>

                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Role Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') ? old('name') : $role->name }}" placeholder="Enter name"
                                        required>
                                    @error('name')
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
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Role Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="choices-publish-status-input" data-choices
                                data-choices-search-false>
                                <option {{ $role->status == 1 ? 'selected' : '' }} value="1" selected>Active</option>
                                <option {{ $role->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            $("#roles-form").validate({
                rules: {
                    name: "required"

                },
                messages: {
                    name: "Please enter role name"
                }
            });
        });
    </script>
@endpush
