@extends('vendor.layouts.main')
@section('title')
    Taxes
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Taxes
        @endslot
        @slot('title')
            Tax Details
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
                        {{ truncate($tax?->title, 100) }}
                    </h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('vendor.taxes.edit', $tax?->id) }}" class="btn btn-success"><i
                                    class="ri-pencil-line align-bottom me-1"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                <div class="col-lg-10">
                    <div class="mt-xl-0 mt-5">
                        <div class="row">
                            <div class="col-md-4 mt-3 text-muted">
                                <h5 class="fs-14">Type:</h5>
                                <div>{{ $tax?->type }}</div>
                            </div>
                            <div class="col-md-4 mt-3 text-muted">
                                <h5 class="fs-14">Amount:</h5>
                                <div>{{ $tax?->amount }}</div>
                            </div>
                            <div class="col-md-4 mt-3 text-muted">
                                <h5 class="fs-14">Status:</h5>
                                <div>
                                    @if ($tax?->active)
                                        <span class="text-success">
                                            <i class="ri-checkbox-circle-line fs-17 align-middle"></i> Active</span>
                                    @else
                                        <span class="text-danger">
                                            <i class="ri-close-circle-line fs-17 align-middle"></i> Inactive</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-muted">
                            <h5 class="fs-14">Description :</h5>
                            <p>
                                {{ $tax?->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
