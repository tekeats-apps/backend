@extends('vendor.layouts.main')

@push('css')
    @include('plugins.dropify.css')
    @include('plugins.editor.css')
    @include('plugins.sweetalert2.css')
@endpush

@section('title', 'Products')

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Products
        @endslot
        @slot('title')
            {{ isset($product) ? 'Edit Product' : 'Create New Product' }}
        @endslot
    @endcomponent

    <form id="product-form"
        action="{{ isset($product) ? route('vendor.products.update', $product->id) : route('vendor.products.store') }}"
        method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset

        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Information<span class="float-end">
                                        <a href="{{ route('vendor.products.list') }}" class="btn btn-info bt-sm">Back to
                                            Products</a>
                                    </span></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label for="category-id-field" class="form-label">Category</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror"
                                                name="category_id" data-choices id="category-id-field">
                                                <option value="">Select Product Category</option>
                                                @isset($categories)
                                                    @foreach ($categories as $key => $category)
                                                        <option value="{{ $key }}"
                                                            {{ old('category_id', isset($product) ? $product->category_id : '') == $key ? 'selected' : '' }}>
                                                            {{ $category }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name"
                                                value="{{ old('name', isset($product) ? $product->name : '') }}"
                                                placeholder="Enter product name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Prepration Time</label>
                                            <input type="text"
                                                class="form-control @error('prepration_time') is-invalid @enderror"
                                                name="prepration_time"
                                                value="{{ old('prepration_time', isset($product) ? $product->prepration_time : '') }}"
                                                placeholder="Enter product prepration time eg. 45 Minutes" required>
                                            @error('prepration_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label for="product-tags-field" class="form-label">Product Tags |
                                                Keywords</label>
                                            <select class="form-control @error('product_tags') is-invalid @enderror"
                                                name="product_tags[]" data-choices data-choices-removeItem multiple
                                                id="product-tags-field">
                                                <option value="">Select Product Tags</option>
                                                @isset($tags)
                                                    @foreach ($tags as $key => $tag)
                                                        <option value="{{ $key }}"
                                                            @if (old('product_tags', isset($product) ? $product->tags->pluck('id')->toArray() : []) &&
                                                                    in_array($key, old('product_tags', isset($product) ? $product->tags->pluck('id')->toArray() : []))) selected @endif>
                                                            {{ $tag }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('product_tags')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Product Price</label>
                                            <input type="number" min="0" step="0.01"
                                                class="form-control @error('price') is-invalid @enderror" name="price"
                                                value="{{ old('price', isset($product) ? $product->price : '') }}"
                                                placeholder="Enter product price" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">Discount (%)</label>
                                            <input type="number" min="0"
                                                class="form-control @error('discount') is-invalid @enderror" name="discount"
                                                oninput="validity.valid||(value='');"
                                                value="{{ old('discount', isset($product) ? $product->discount : '') }}"
                                                placeholder="Enter discount value in %">
                                            @error('discount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <label for="description-field" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description-field"
                                            rows="5">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">SEO Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">SEO Title</label>
                                            <input type="text"
                                                class="form-control @error('seo_title') is-invalid @enderror"
                                                name="seo_title"
                                                value="{{ old('seo_title', isset($product) ? $product->seo_title : '') }}"
                                                placeholder="Enter title for SEO">
                                            @error('seo_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="mb-3">
                                            <label class="form-label">SEO Keywords</label>
                                            <select class="form-control @error('seo_keywords') is-invalid @enderror"
                                                name="seo_keywords[]" data-choices data-choices-text-unique-true
                                                data-choices-removeItem multiple id="seo-keywords-field">
                                                <option value="">Select/Create Keywords</option>
                                            </select>
                                            @error('seo_keywords')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <label for="seo-description-field" class="form-label">SEO Description</label>
                                        <textarea class="form-control @error('seo_description') is-invalid @enderror" name="seo_description"
                                            id="seo-description-field" r dd($product->discounted_price);ows="5">{{ old('seo_description', isset($product) ? $product->seo_description : '') }}</textarea>
                                        @error('seo_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Image & Options</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-2">Product Image</h5>
                                    <div class="col-md-12">
                                        @if (isset($product) && !empty($product->image))
                                            <input type="file" class="dropify @error('image') is-invalid @enderror"
                                                data-max-file-size="1M" data-show-remove="false" name="image"
                                                data-default-file={{ $product->image }} />
                                        @else
                                            <input type="file" class="dropify @error('image') is-invalid @enderror"
                                                data-max-file-size="1M" data-show-remove="false" name="image" />
                                        @endif

                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input class="form-check-input @error('featured') is-invalid @enderror"
                                                type="checkbox" name="featured" id="SwitchCheck11" value="1"
                                                {{ old('featured', isset($product) && $product->featured ? 'checked' : '') }}>
                                            <label class="form-check-label" for="SwitchCheck11">Featured</label>
                                        </div>
                                        @error('featured')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input class="form-check-input @error('extras') is-invalid @enderror"
                                                type="checkbox" name="extras" id="extras" value="1"
                                                {{ old('extras', isset($product) && $product->extras ? 'checked' : '') }}>
                                            <label class="form-check-label" for="extras">Enable Extras</label>
                                        </div>
                                        @error('extras')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input
                                                class="form-check-input @error('is_variants_enabled') is-invalid @enderror"
                                                type="checkbox" name="is_variants_enabled" id="is_variants_enabled"
                                                value="1"
                                                {{ old('is_variants_enabled', isset($product) && $product->is_variants_enabled ? 'checked' : '') }}>
                                            <label class="form-check-label" for="is_variants_enabled">Enable
                                                Variants</label>
                                        </div>
                                        @error('is_variants_enabled')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input
                                                class="form-check-input @error('discount_enabled') is-invalid @enderror"
                                                type="checkbox" name="discount_enabled" id="SwitchCheck11"
                                                value="1"
                                                {{ old('discount_enabled', isset($product) && $product->discount_enabled ? 'checked' : '') }}>
                                            <label class="form-check-label" for="SwitchCheck11">Enable Discount</label>
                                        </div>
                                        @error('discount_enabled')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input
                                                class="form-check-input @error('is_product_timing_enabled') is-invalid @enderror"
                                                type="checkbox" name="is_product_timing_enabled"
                                                id="is_product_timing_enabled" value="1"
                                                {{ old('is_product_timing_enabled', isset($product) && $product->extras ? 'checked' : '') }}>
                                            <label class="form-check-label" for="is_product_timing_enabled">Enable Product
                                                Timing</label>
                                        </div>
                                        @error('is_product_timing_enabled')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch form-switch-lg form-switch-success">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="checkbox" name="status" id="SwitchCheck12" value="1"
                                                {{ old('status', isset($product) && $product->status ? 'checked' : '') }}>
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
                    @if (isset($product))
                        @livewire('vendor.products.extras.extras-list', ['productId' => $product->id])
                        @livewire('vendor.products.variants.variant-list', ['productId' => $product->id])

                        @livewire('vendor.products.extras.product-extra', ['productId' => $product->id])
                        @livewire('vendor.products.variants.product-variant', ['productId' => $product->id])
                    @endisset
            </div>
        </div>
    </div>
</form>
@endsection

@push('script')
@include('plugins.dropify.js')
@include('plugins.editor.js')
@include('plugins.sweetalert2.js')
<script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#product-form").validate({
            rules: {
                name: "required",
                category_id: "required",
                price: {
                    required: true,
                    number: true,
                    min: 0
                },
                prepration_time: {
                    required: false,
                    minlength: 2,
                    maxlength: 50
                }
            },
            messages: {
                name: "Please enter a product name (e.g Fast Food)",
                category_id: "Please select a product category.",
                price: {
                    required: "Please enter a product price.",
                    number: "The price must be a valid number.",
                    min: "The price must be 0 or more."
                },
                prepration_time: {
                    minlength: "Preparation time must be at least 2 characters long.",
                    maxlength: "Preparation time must not exceed 50 characters."
                },
                product_tags: "Please select at least one product tag."
            }
        });

    });
</script>
@endpush
