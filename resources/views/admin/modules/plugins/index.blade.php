@extends('admin.layouts.main')
@section('title')
    @lang('translation.plugins')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.plugins')
        @endslot
        @slot('title')
            Manage Plugins
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        @if (session('error'))
            <div class="mx-3 text-danger">{{ session('error') }}</div>
        @endif
        <div class="col-lg-12">
            @livewire('admin.plugins.plugin-list')
        </div>
        <!--end col-->
    </div>
@endsection
