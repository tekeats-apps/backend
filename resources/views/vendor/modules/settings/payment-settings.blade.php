@extends('store.layouts.main')
@section('title')
    @lang('translation.users')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('store.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Payment Gateway Settings </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">🌟 Simplify payments with a breeze! Explore our vibrant App/Plugins Store and
                        effortlessly configure your preferred payment gateway for smooth transactions. 💳✨</p>
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="custom-v-pills-paypal-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-paypal" role="tab" aria-controls="custom-v-pills-paypal"
                                    aria-selected="true">
                                    <i class="ri-paypal-fill d-block fs-20 mb-1"></i>
                                    PayPal</a>
                                <a class="nav-link" id="custom-v-pills-stripe-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-stripe" role="tab" aria-controls="custom-v-pills-stripe"
                                    aria-selected="false">
                                    <i class="bx bxl-stripe d-block fs-20 mb-1"></i>
                                    Stripe</a>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                @include('store.modules.settings.partials.payments.paypal')
                                @include('store.modules.settings.partials.payments.stripe')
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
