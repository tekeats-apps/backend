@extends('vendor.layouts.main')
@push('css')
    @include('vendor.layouts.components.plugins.datatable.datatables-css')
    {{-- @include('plugins.dropify.css') --}}
@endpush
@section('title')
    Categories
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Categories
        @endslot
        @slot('title')
            Manage Categories
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.categories.category')
        </div>
    </div>
@endsection
@push('script')
    @include('vendor.layouts.components.plugins.datatable.datatables-js')
    {{-- @include('plugins.dropify.js') --}}
@endpush
