@extends('vendor.layouts.main')
@section('title')
    @lang('translation.orders')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.orders')
        @endslot
        @slot('title')
            @lang('translation.manage-orders')
        @endslot
    @endcomponent
    @livewire('vendor.orders.create-order')
@endsection
