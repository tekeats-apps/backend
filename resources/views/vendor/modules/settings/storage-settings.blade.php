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
                    <h5 class="card-title mb-0">Storage Settings </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">🔒 Configure Storage Settings: Enable storage plugins (📦) like S3 Bucket (⚡️) for your admin dashboard.</p>
                    <div class="row mt-5">
                        <div class="col-lg-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="custom-v-pills-s3-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-s3" role="tab" aria-controls="custom-v-pills-s3"
                                    aria-selected="true">
                                    <i class="bx bx-cloud-upload d-block fs-20 mb-1"></i>
                                    S3 Bucket</a>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                @include('store.modules.settings.partials.storage.s3-bucket')
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
