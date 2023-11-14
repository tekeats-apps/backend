<div>
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0"> {{ $order->order_id }}</h5>
                        {{-- <div class="flex-shrink-0">
                            <a href="apps-invoices-details" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Item Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($order->items)
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        <img src="{{ $item->product->image }}" alt=""
                                                            class="img-fluid d-block">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15"><a href="#"
                                                                class="link-primary">{{ $item->product->name }}</a></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="fw-medium text-end">
                                                ${{ $item->total }}
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif
                                <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total :</td>
                                                    <td class="text-end">${{ $order->subtotal_price }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Discount <span class="text-muted">(VELZON15)</span> : :</td>
                                                    <td class="text-end">-$53.99</td>
                                                </tr> --}}
                                                {{-- <tr>
                                                    <td>Delivery Charge :</td>
                                                    <td class="text-end">$65.00</td>
                                                </tr> --}}
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Total (USD) :</th>
                                                    <th class="text-end">${{ $order->total_price }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end card-->


        </div><!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $order->customer->avatar }}" alt="" class="avatar-sm rounded">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $order->customer->full_name }}</h6>
                                    <p class="text-muted mb-0">Customer</p>
                                </div>
                            </div>
                        </li>
                        <li><i
                                class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->customer->email }}
                        </li>
                        @if ($order->customer->phone_number)
                            <li><i
                                    class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->customer->phone_number }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                        Payment Details</h5>
                </div>
                <div class="card-body">
                    {{-- <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Transactions:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">#VLZ124561278124</h6>
                        </div>
                    </div> --}}
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment Method:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $order->payment_method }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            @livewire('vendor.orders.order-status-updater', ['order' => $order])

            @if ($order->order_type == App\Enums\Vendor\Orders\OrderType::DELIVERY)
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0"><i
                                    class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Rider
                                Details
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                                colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                            <h5 class="fs-16 mt-2">Jhon Rider</h5>
                            <p class="text-muted mb-0">Registration Plate: MFDS1400457854</p>
                            <p class="text-muted mb-0">Phone Number : +122939239329</p>
                        </div>
                    </div>
                </div><!--end card-->
            @endif

            @if ($order->order_type == App\Enums\Vendor\Orders\OrderType::DELIVERY)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                            Delivery
                            Address</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">Joseph Parker</li>
                            <li>+(256) 245451 451</li>
                            <li>2186 Joyce Street Rocky Mount</li>
                            <li>California - 24567</li>
                            <li>United States</li>
                        </ul>
                    </div>
                </div><!--end card-->
            @endif

        </div><!--end col-->
    </div><!--end row-->
</div>
