@extends('vendor.layouts.main')
@section('title')
    Coupons
@endsection
@push('css')
    @include('plugins.sweetalert2.css')
@endpush
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Coupons
        @endslot
        @slot('title')
            Manage Coupons
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.coupons.coupon-list')
        </div>
        <!--end col-->
    </div>
@endsection
@push('script')
    @include('plugins.sweetalert2.js')
@endpush
