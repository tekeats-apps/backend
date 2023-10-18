@extends('admin.layouts.main')
@section('title')
    Plan Features
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plan Features
        @endslot
        @slot('title')
            Plan Feature Details
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0);" onclick="history.back()" class="me-2" title="back"><i
                            class="ri-arrow-left-line back"></i></a>
                    <h5 class="card-title mb-0 flex-grow-1">
                        {{ truncate($planFeature?->feature_name, 100) }}
                    </h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.plans.features.edit', $planFeature?->id) }}"
                                class="btn btn-success"><i class="ri-pencil-line align-bottom me-1"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                <div class="col-lg-8">
                    <div class="mt-xl-0 mt-5">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                {{-- <h4>{{ $planFeature?->feature_name }}</h4> --}}
                            </div>
                        </div>

                        <div class="mt-4 text-muted">
                            <h5 class="fs-14">Description :</h5>
                            <p>
                                {{ $planFeature?->feature_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
