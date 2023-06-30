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
    <form id="roles-form" action="{{ route('vendor.roles.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Role Information <span class="float-end">
                                <a href="{{ route('vendor.roles.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Roles </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Role Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') ? old('name') : '' }}" placeholder="Enter name" required>
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
