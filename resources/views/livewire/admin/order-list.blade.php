<div class="card" id="invoiceList">
    <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">Orders</h5>
            <div class="flex-shrink-0">
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i
                            class="ri-delete-bin-2-line"></i></button>
                    <a href="{{ route('admin.order.create') }}" class="btn btn-success"><i
                            class="ri-add-line align-bottom me-1"></i> Create Invoice</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
        <form>
            <div class="row g-3">
                <div class="col-xxl-5 col-sm-12">
                    <div class="search-box">
                        <input type="text" class="form-control search bg-light border-light"
                            placeholder="Search for customer, email, country, status or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-3 col-sm-4">
                    <input type="text" class="form-control bg-light border-light" id="datepicker-range"
                        placeholder="Select date">
                </div>
                <!--end col-->
                <div class="col-xxl-3 col-sm-4">
                    <div class="input-light">
                        <select class="form-control" data-choices data-choices-search-false
                            name="choices-single-default" id="idStatus">
                            <option value="">Status</option>
                            <option value="all" selected>All</option>
                            <option value="Unpaid">Unpaid</option>
                            <option value="Paid">Paid</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Refund">Refund</option>
                        </select>
                    </div>
                </div>
                <!--end col-->

                <div class="col-xxl-1 col-sm-4">
                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                        <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                    </button>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </form>
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
                        <th class="sort text-uppercase" scope="col">Customer Name</th>
                        <th class="sort text-uppercase" scope="col">Customer Email</th>
                        <th class="sort text-uppercase" scope="col">Payment Status</th>
                        <th class="sort text-uppercase" scope="col">Status</th>
                        <th class="text-uppercase" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($orders)
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="responsivetableCheck01">
                                        <label class="form-check-label" for="responsivetableCheck01"></label>
                                    </div>
                                </th>
                                <td><a href="#" class="fw-semibold">#{{ $order->invoice_no }}</a></td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-3.jpg" alt=""
                                                class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ $order->customer_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->email }}</td>
                                <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                    {{ $order->payment_status }}</td>

                                <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                    {{ $order->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><button class="dropdown-item" href="javascript:void(0);"
                                                    onclick="ViewInvoice(this);" data-id="` + raw.invoice_no + `"><i
                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                    View</button></li>
                                            <li><button class="dropdown-item" href="javascript:void(0);"
                                                    onclick="EditInvoice(this);" data-id="` + raw.invoice_no + `"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Edit</button></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ri-download-2-line align-bottom me-2 text-muted"></i>
                                                    Download</a></li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                    href="#deleteOrder">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            <div class="noresult" style="display:none">
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
                            <h4>You are about to delete a order ?</h4>
                            <p class="text-muted fs-15 mb-4">Deleting your order will remove
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
