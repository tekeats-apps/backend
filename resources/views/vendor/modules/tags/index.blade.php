@extends('vendor.layouts.main')
@push('css')
    @include('vendor.layouts.components.plugins.datatable.datatables-css')
    @include('plugins.sweetalert2.css')
@endpush
@section('title')
    Tags
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Tags
        @endslot
        @slot('title')
            Manage Tags
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.tags.tag-list')
        </div>
    </div>
@endsection
@push('script')
    @include('vendor.layouts.components.plugins.datatable.datatables-js')
    @include('plugins.sweetalert2.js')
@endpush
