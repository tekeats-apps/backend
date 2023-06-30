@extends('vendor.layouts.main')

@push('css')
    @include('plugins.dropify.css')
@endpush

@section('title', 'Categories')

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Categories
        @endslot
        @slot('title')
            {{ isset($category) ? 'Edit Category' : 'Create New Category' }}
        @endslot
    @endcomponent

    <form id="category-form"
        action="{{ isset($category) ? route('vendor.categories.update', $category->id) : route('vendor.categories.store') }}"
        method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @isset($category)
            @method('PUT')
        @endisset

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Category Information<span class="float-end">
                                <a href="{{ route('vendor.categories.list') }}" class="btn btn-info bt-sm">Back to
                                    Categories</a>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', isset($category) ? $category->name : '') }}"
                                        placeholder="Enter category name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label for="position-field" class="form-label">Position</label>
                                    <select class="form-control @error('position') is-invalid @enderror" name="position"
                                        id="position-field">
                                        <option value="">Select Position</option>
                                        @isset($positions)
                                            @foreach ($positions as $position)
                                                <option value="{{ $position }}"
                                                    {{ old('position', isset($category) ? $category->position : '') == $position ? 'selected' : '' }}
                                                    {{ in_array($position, $usedPositions) ? 'disabled' : '' }}>
                                                    {{ $position }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="description-field" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description-field"
                                    rows="5">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                        <h5 class="card-title mb-0">Category Icon & Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-2">Category Icon</h5>
                            <div class="col-md-12">
                                @if (isset($category) && !empty($category->image))
                                    <input type="file" class="dropify @error('image') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="false" data-max-width="300"
                                        data-max-height="300" name="image"
                                        data-default-file={{ $category->image }} />
                                @else
                                    <input type="file" class="dropify @error('image') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="false" data-max-width="300"
                                        data-max-height="300" name="image" />
                                @endif

                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch form-switch-lg form-switch-info">
                                <input class="form-check-input @error('featured') is-invalid @enderror" type="checkbox"
                                    name="featured" id="SwitchCheck11" value="1"
                                    {{ old('featured', isset($category) && $category->featured ? 'checked' : '') }}>
                                <label class="form-check-label" for="SwitchCheck11">Featured</label>
                            </div>
                            @error('featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch form-switch-lg form-switch-success">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                                    name="status" id="SwitchCheck12" value="1"
                                    {{ old('status', isset($category) && $category->status ? 'checked' : '') }}>
                                <label class="form-check-label" for="SwitchCheck12">Active</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    @include('plugins.dropify.js')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#category-form").validate({
                rules: {
                    name: "required"
                },
                messages: {
                    name: "Please enter a category name (e.g., Fast Food)",
                }
            });
        });
    </script>
@endpush
