@extends('vendor.layouts.main')
@section('title')
    {{ __('System Settings') }}
@endsection
@push('css')
    @include('plugins.dropify.css')
@endpush

@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
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
                                <a class="nav-link {{ $tab === 'custom-v-pills-restaurant-info' ? 'active' : '' }}"
                                    id="custom-v-pills-restaurant-info-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-restaurant-info" role="tab"
                                    aria-controls="custom-v-pills-restaurant-info"
                                    aria-selected="{{ $tab === 'custom-v-pills-restaurant-info' ? 'true' : 'false' }}">
                                    <i class="ri-store-2-fill d-block fs-20 mb-1"></i>
                                    Restaurant Info</a>
                                <a class="nav-link {{ $tab === 'custom-v-pills-media' ? 'active' : '' }}"
                                    id="custom-v-pills-media-tab" data-bs-toggle="pill" href="#custom-v-pills-media"
                                    role="tab" aria-controls="custom-v-pills-media"
                                    aria-selected="{{ $tab === 'custom-v-pills-media' ? 'true' : 'false' }}">
                                    <i class="ri-image-2-fill d-block fs-20 mb-1"></i>
                                    Media</a>
                                <a class="nav-link {{ $tab === 'custom-v-pills-delivery-settings' ? 'active' : '' }}"
                                    id="custom-v-pills-delivery-settings-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-delivery-settings" role="tab"
                                    aria-controls="custom-v-pills-delivery-settings"
                                    aria-selected="{{ $tab === 'custom-v-pills-delivery-settings' ? 'true' : 'false' }}">
                                    <i class="ri-truck-fill d-block fs-20 mb-1"></i>
                                    Delivery</a>
                                <a class="nav-link {{ $tab === 'custom-v-pills-localization' ? 'active' : '' }}"
                                    id="custom-v-pills-localization-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-localization" role="tab"
                                    aria-controls="custom-v-pills-localization"
                                    aria-selected="{{ $tab === 'custom-v-pills-localization' ? 'true' : 'false' }}">
                                    <i class="ri-settings-4-fill d-block fs-20 mb-1"></i>
                                    Localization</a>
                                <a class="nav-link {{ $tab === 'custom-v-pills-ordering' ? 'active' : '' }}"
                                    id="custom-v-pills-ordering-tab" data-bs-toggle="pill" href="#custom-v-pills-ordering"
                                    role="tab" aria-controls="custom-v-pills-ordering"
                                    aria-selected="{{ $tab === 'custom-v-pills-ordering' ? 'true' : 'false' }}">
                                    <i class="ri-shopping-cart-2-fill d-block fs-20 mb-1"></i>
                                    Online Ordering</a>

                            </div>

                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                @include('vendor.modules.settings.partials.system.restaurant-info')
                                @include('vendor.modules.settings.partials.system.delivery')
                                @include('vendor.modules.settings.partials.system.localization')
                                @include('vendor.modules.settings.partials.system.ordering')
                                @include('vendor.modules.settings.partials.system.media')
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
@push('script')
    @include('plugins.dropify.js')
    <script>
        $(document).ready(function() {
            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }
            var tabName = getParameterByName('tab');
            if (tabName) {
                $('.nav-pills .nav-link').removeClass('active');
                $('#' + tabName + '-tab').addClass('active');

                $('.tab-content .tab-pane').removeClass('active show');
                $('#' + tabName).addClass('active show');
            }

            $('.nav-pills .nav-link').click(function(e) {
                e.preventDefault();
                var tabId = $(this).attr('id').replace('-tab', '');
                history.pushState(null, '', '?tab=' + tabId);
                $('.nav-pills .nav-link, .tab-content .tab-pane').removeClass('active show');
                $(this).addClass('active');
                $('#' + tabId).addClass('active show');
            });
        });
    </script>
@endpush
