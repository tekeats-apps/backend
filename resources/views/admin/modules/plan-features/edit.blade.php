@extends('admin.layouts.main')
@section('title')
    Plan Features
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plan Features
        @endslot
        @slot('title')
            Manage Plan Features
        @endslot
    @endcomponent
    <form id="plan-feature-form" action="{{ route('admin.plans.features.update', $planFeature?->id) }}" method="POST" autocomplete="off">
        @csrf @method('PUT')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Plan Features Information <span class="float-end">
                                <a href="{{ route('admin.plans.features.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Plan Features </a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Feature Name</label>
                                    <input type="text" class="form-control @error('feature_name') is-invalid @enderror"
                                        name="feature_name" value="{{ $planFeature?->feature_name }}" id="feature_name"
                                        placeholder="Enter feature name" required>
                                    @error('feature_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Feature Description</label>
                                    <textarea class="form-control @error('feature_description') is-invalid @enderror" name="feature_description"
                                        placeholder="Enter feaure description" id="feature_description">{{ $planFeature?->feature_description }}</textarea>
                                    @error('feature_description')
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
            $("#plan-feature-form").validate({
                rules: {
                    feature_name: "required",
                    feature_description: "required",
                },
                messages: {
                    feature_name: "Please enter the feature name",
                    feature_description: "Please enter the feature description",
                }
            });
        });
    </script>
@endpush
