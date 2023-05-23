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
                    <h5 class="card-title mb-0">Notification Channel Settings </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">🔔 Stay in the loop! Enable the App/Plugins Store notification channel to configure
                        your system's notifications effortlessly. 🌟</p>
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="custom-v-pills-onesignal-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-onesignal" role="tab" aria-controls="custom-v-pills-onesignal"
                                    aria-selected="true">
                                    <i class="ri-notification-fill d-block fs-20 mb-1"></i>
                                    Onesignal</a>
                                {{-- <a class="nav-link" id="custom-v-pills-pusher-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-pusher" role="tab" aria-controls="custom-v-pills-pusher"
                                    aria-selected="false">
                                    <i class="bx bx-notification d-block fs-20 mb-1"></i>
                                    Pusher</a>
                                <a class="nav-link" id="custom-v-pills-firebase-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-firebase" role="tab" aria-controls="custom-v-pills-firebase"
                                    aria-selected="false">
                                    <i class="bx bxl-firebase d-block fs-20 mb-1"></i>
                                    Firebase</a> --}}
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                @include('store.modules.settings.partials.notifications.onesignal')
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
