@extends('admin.layouts.main')
@section('title')
    Subscription Plans
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
        Subscription Plans
        @endslot
        @slot('title')
        Subscription Plan Details
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0);" onclick="history.back()" class="me-2" title="back"><i class="ri-arrow-left-line back"></i></a>
                    <h5 class="card-title mb-0 flex-grow-1">
                        {{ truncate($planSubscription?->name, 100) }}
                    </h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.plans.subscriptions.edit', $planSubscription?->uuid) }}" class="btn btn-success"><i
                                    class="ri-pencil-line align-bottom me-1"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                <div class="col-lg-8">
                    <div class="mt-xl-0 mt-5">
                        <div class="row">
                            <div class="col-md-6 mt-3 text-muted">
                                <h5 class="fs-14">Duration:</h5>
                                <div>{{ $planSubscription?->duration }}</div>
                            </div>
                            <div class="col-md-6 mt-3 text-muted">
                                <h5 class="fs-14">Price:</h5>
                                <div>{{ $planSubscription?->price }}</div>
                            </div>
                            <div class="col-md-6 mt-3 text-muted">
                                <h5 class="fs-14">Discount:</h5>
                                <div>{{ $planSubscription?->discount }}</div>
                            </div>
                            <div class="col-md-6 mt-3 text-muted">
                                <h5 class="fs-14">Trial Period:</h5>
                                <div>{{ $planSubscription?->trial_period_days }}</div>
                            </div>
                        </div>
                        <div class="mt-4 text-muted">
                            <h5 class="fs-14">Description :</h5>
                            <p>
                                {{ $planSubscription?->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
