@extends('admin.layouts.main')
@section('title')
    Plugin Types
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plugin Types
        @endslot
        @slot('title')
            Manage Plugin Types
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        @if (session('error'))
            <div class="mx-3 text-danger">{{ session('error') }}</div>
        @endif
        <div class="col-lg-12">
            @livewire('admin.plugins.plugin-type')
        </div>
        <!--end col-->
    </div>
@endsection
