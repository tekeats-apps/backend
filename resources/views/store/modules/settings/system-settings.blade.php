@extends('store.layouts.main')
@section('title')
    {{ __('System Settings') }}
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('store.layouts.components.breadcrumb')
        @slot('li_1')
            {{ __('System Settings') }}
        @endslot
        @slot('title')
            {{ __('Manage System Settings') }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('System Settings') }}</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">🔧 Manage and customize key aspects of your restaurant's operations, 🌐 online
                        presence, 🚀 mobile app, and more to deliver a seamless and delightful dining experience.</p>
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="custom-v-pills-restaurant-info-tab"
                                    data-bs-toggle="pill" href="#custom-v-pills-restaurant-info" role="tab"
                                    aria-controls="custom-v-pills-restaurant-info" aria-selected="true">
                                    <i class="ri-store-2-fill d-block fs-20 mb-1"></i>
                                    Restaurant Info</a>
                                <a class="nav-link" id="custom-v-pills-delivery-settings-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-delivery-settings" role="tab"
                                    aria-controls="custom-v-pills-delivery-settings" aria-selected="false">
                                    <i class="ri-truck-fill d-block fs-20 mb-1"></i>
                                    Delivery</a>
                                <a class="nav-link" id="custom-v-pills-localization-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-localization" role="tab"
                                    aria-controls="custom-v-pills-localization" aria-selected="false">
                                    <i class="ri-settings-4-fill d-block fs-20 mb-1"></i>
                                    Localization</a>
                                <a class="nav-link" id="custom-v-pills-ordering-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-ordering" role="tab" aria-controls="custom-v-pills-ordering"
                                    aria-selected="false">
                                    <i class="ri-shopping-cart-2-fill d-block fs-20 mb-1"></i>
                                    Online Ordering</a>
                                <a class="nav-link" id="custom-v-pills-menu-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-menu" role="tab" aria-controls="custom-v-pills-menu"
                                    aria-selected="false">
                                    <i class="ri-shopping-basket-2-line d-block fs-20 mb-1"></i>
                                    Menu Management</a>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                @include('store.modules.settings.partials.system.restaurant-info')
                                @include('store.modules.settings.partials.system.delivery')
                                @include('store.modules.settings.partials.system.localization')
                                @include('store.modules.settings.partials.system.ordering')
                                @include('store.modules.settings.partials.system.menu')
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
