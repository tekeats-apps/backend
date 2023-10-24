<div>
    @include('plugins.alerts.alerts')
    <div class="card">
        <div class="card-header border-bottom-dashed">
            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">Coupons</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <a type="button" href="{{ route('vendor.coupons.create') }}"
                            class="btn btn-success btn-label waves-effect waves-light"><i
                                class="ri-add-line label-icon align-middle fs-16 me-2"></i> Add New Coupon</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
            <div class="row g-3">
                <div class="col-xxl-4 col-sm-12">
                    <label for="search"> Search</label>
                    <div class="search-box">
                        <input type="text" wire:model.debounce.500ms="search" id="search"
                            class="form-control search bg-light border-light"
                            placeholder="Search for coupon code, amount, status or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                {{-- <div class="col-xxl-2 col-sm-4">
                    <label for="status"> Status</label>
                    <div class="input-light" wire:ignore>
                        <select class="form-control" wire:model.debounce.500ms="active" data-choices
                            data-choices-search-false>
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table nowrap align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10px;">
                            <div class="form-check">
                                <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="1">
                            </div>
                        </th>
                        <th>Coupon Code</th>
                        <th>Amount Type</th>
                        <th>Amount</th>
                        <th>Allowed Time</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $key => $coupon)
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" id="coupon_{{ $coupon?->id }}"
                                        type="checkbox" value="1">
                                </div>
                            </th>
                            <td>
                                {{ $coupon?->coupon_code }}
                            </td>
                            <td>
                                {{ $coupon?->amount_type?->value }}
                            </td>
                            <td>
                                {{ $coupon?->amount }}
                            </td>
                            <td>
                                {{ $coupon?->allowed_time ?? 'Unlimited' }}
                            </td>
                            <td>
                                @if ($coupon?->expiry_date)
                                    {{ $coupon?->expiry_date }}
                                @else
                                    <span class="text-muted user-select-none">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if ($coupon?->active?->value)
                                    <span class="text-success">
                                        <i class="ri-checkbox-circle-line fs-17 align-middle"></i> Active</span>
                                @else
                                    <span class="text-danger">
                                        <i class="ri-close-circle-line fs-17 align-middle"></i> Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="{{ route('vendor.coupons.edit', $coupon?->id) }}"
                                                class="dropdown-item edit-item-btn" role="button"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                Edit</a>
                                        </li>
                                        <a class="dropdown-item remove-item-btn" role="button"
                                            wire:click="confirmDelete('{{ $coupon?->id }}')">
                                            <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                            Delete
                                        </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item status-change-btn" role="button"
                                                wire:click="toggleStatus({{ $coupon?->id }})"
                                                data-status="{{ $coupon?->active?->value }}">
                                                <i
                                                    class="{{ $coupon?->active?->value ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                {{ $coupon?->active?->value ? 'Deactivate' : 'Activate' }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @unless (count($coupons))
                <div class="noresult">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                        </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched our all records
                            did not find any
                            tax details for you search.</p>
                    </div>
                </div>
            @endunless
            <div class="d-flex justify-content-end">
                {{ $coupons?->links() }}
            </div>
        </div>
    </div>

</div>
