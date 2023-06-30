@extends('vendor.layouts.main')

@section('title', 'Tags')

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Tags
        @endslot
        @slot('title')
            {{ isset($tag) ? 'Edit Tag' : 'Create New Tag' }}
        @endslot
    @endcomponent

    <form id="tag-form"
        action="{{ isset($tag) ? route('vendor.tags.update', $tag->id) : route('vendor.tags.store') }}"
        method="POST" autocomplete="off">
        @csrf
        @isset($tag)
            @method('PUT')
        @endisset

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tag Information<span class="float-end">
                                <a href="{{ route('vendor.tags.list') }}" class="btn btn-info bt-sm">Back to
                                    Tags</a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Tag Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', isset($tag) ? $tag->name : '') }}"
                                        placeholder="Enter tag name" required>
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
    </form>
@endsection

@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#tag-form").validate({
                rules: {
                    name: "required"
                },
                messages: {
                    name: "Please enter a tag name (e.g., Fast Food)",
                }
            });
        });
    </script>
@endpush
