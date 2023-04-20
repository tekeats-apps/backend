<div class="card" id="invoiceList">
    <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">@lang('translation.restaurants')</h5>
            {{-- <div class="flex-shrink-0">
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i
                            class="ri-delete-bin-2-line"></i></button>
                    <a href="{{ route('admin.restaurant.create') }}" class="btn btn-success"><i
                            class="ri-add-line align-bottom me-1"></i> Create Invoice</a>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
        <div class="row g-3">
            <div class="col-xxl-4 col-sm-12">
                <label for="search"> Search</label>
                <div class="search-box">
                    <input type="text" wire:model.debounce.500ms="search" id="search"
                        class="form-control search bg-light border-light"
                        placeholder="Search for customer, email, invoice, status or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-xxl-2 col-sm-4">
                <label for="status"> Order Status</label>
                <div class="input-light">
                    <select class="form-control" wire:model.debounce.500ms="status" data-choices
                        data-choices-search-false>
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="blocked">Blocked</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="responsivetableCheck">
                                <label class="form-check-label" for="responsivetableCheck"></label>
                            </div>
                        </th>
                        <th class="sort text-uppercase" scope="col">#</th>
                        <th class="sort text-uppercase" scope="col">Customer Email</th>
                        <th class="sort text-uppercase" scope="col" wire:click="sortBy('customer_name')">Restaurant
                            Name</th>
                        <th class="sort text-uppercase" scope="col">Domain</th>
                        <th class="sort text-uppercase" scope="col">Datababse</th>
                        <th class="sort text-uppercase" scope="col">Status</th>
                        <th class="sort text-uppercase" scope="col" wire:click="sortBy('created_at')">Date</th>
                        <th class="text-uppercase" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($restaurants)
                        @foreach ($restaurants as $restaurant)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="responsivetableCheck01">
                                        <label class="form-check-label" for="responsivetableCheck01"></label>
                                    </div>
                                </th>
                                <td><a href="#" class="fw-semibold">#{{ $restaurant->id }}</a></td>
                                <td>{{ $restaurant->customer_email }}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-grow-1">
                                            {{ $restaurant->store_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $restaurant->domain ? $restaurant->domain : $restaurant->domains->first()->domain }}
                                </td>
                                <td>{{ $restaurant->tenancy_db_name }}</td>
                                @if ($restaurant->status == 'active')
                                    <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                        {{ ucfirst($restaurant->status) }}</td>
                                @elseif ($restaurant->status == 'unpaid')
                                    <td class="text-warning"><i class="ri-refresh-line fs-17 align-middle"></i>
                                        {{ ucfirst($restaurant->status) }}</td>
                                @else
                                    <td class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i>
                                        {{ ucfirst($restaurant->status) }}</td>
                                @endif
                                <td>{{ $restaurant->created_at }}</td>
                                <td>
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item" href="javascript:void(0);"
                                                onclick="EditInvoice(this);" data-id="` + raw.invoice_no + `"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Edit</button></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-download-2-line align-bottom me-2 text-muted"></i>
                                                Login as Admin</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                href="#deleteOrder">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            {{-- <div>
                {{ $orders->links() }}
            </div> --}}
            @unless (count($restaurants))
                <div class="noresult">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                        </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched more than 150+ invoices We
                            did not find any
                            invoices for you search.</p>
                    </div>
                </div>
            @endunless

            <!-- end table -->
        </div>
        <!-- end table responsive -->

        <!-- Modal -->
        <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-labelledby="deleteOrderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                        </lord-icon>
                        <div class="mt-4 text-center">
                            <h4>You are about to delete a restaurant ?</h4>
                            <p class="text-muted fs-15 mb-4">Deleting your restaurant will remove
                                all of
                                your information from our database.</p>
                            <div class="hstack gap-2 justify-content-center remove">
                                <button class="btn btn-link link-success fw-medium text-decoration-none"
                                    data-bs-dismiss="modal" id="deleteRecord-close"><i
                                        class="ri-close-line me-1 align-middle"></i>
                                    Close</button>
                                <button class="btn btn-danger" id="delete-record">Yes,
                                    Delete It</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal -->
    </div>
</div>
