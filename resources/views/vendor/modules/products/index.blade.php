@extends('vendor.layouts.main')
@push('css')
    @include('vendor.layouts.components.plugins.datatable.datatables-css')
    @include('plugins.dropify.css')
    @include('plugins.sweetalert2.css')
@endpush
@section('title')
    Products
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Products
        @endslot
        @slot('title')
            Manage Products
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.products.product-list')
        </div>
    </div>
@endsection
@push('script')
    @include('vendor.layouts.components.plugins.datatable.datatables-js')
    @include('plugins.dropify.js')
    @include('plugins.sweetalert2.js')
@endpush
