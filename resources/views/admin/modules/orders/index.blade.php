@extends('admin.layouts.main')
@section('title')
    @lang('translation.orders')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.orders')
        @endslot
        @slot('title')
            @lang('translation.manage-orders')
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('admin.orders.order-list')
        </div>
        <!--end col-->
    </div>
@endsection
@push('script')
    <script src="{{ URL::asset('assets/js/pages/orders/orders-list.js') }}"></script>
@endpush
