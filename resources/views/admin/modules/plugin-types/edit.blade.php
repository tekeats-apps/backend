@extends('admin.layouts.main')
@section('title')
    Plugin Types
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plugin Types
        @endslot
        @slot('title')
            Manage Plugins
        @endslot
    @endcomponent
    <form id="plugin-type-form" action="{{ route('admin.plugin.types.update', $pluginType?->id) }}" method="POST" autocomplete="off">
        @csrf @method('PUT')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><span class="float-end">
                                <a href="{{ route('admin.plugin.types.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Plugin Types </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $pluginType?->name }}" id="name"
                                        placeholder="Enter name" required autofocus>
                                    @error('name')
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
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            $("#plugin-type-form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter the name",
                }
            });
        });
    </script>
@endpush
