@extends('vendor.layouts.main')
@push('css')
    @include('vendor.layouts.components.plugins.datatable.datatables-css')
@endpush
@section('title')
    @lang('translation.users')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.users.user-list')
        </div>
    </div>
@endsection
@push('script')
    @include('vendor.layouts.components.plugins.datatable.datatables-js')
@endpush
