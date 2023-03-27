@extends('admin.layouts.main')
@push('css')
    @include('admin.layouts.components.plugins.datatable.datatables-css')
@endpush
@section('title')
    @lang('translation.restaurants')
@endsection
@section('content')

    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.restaurants')
        @endslot
        @slot('title')
            @lang('translation.manage-restaurants')
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom-dashed">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>
                                <h5 class="card-title mb-0">Restaurants List</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
@push('script')
    @include('admin.layouts.components.plugins.datatable.datatables-js')
@endpush
