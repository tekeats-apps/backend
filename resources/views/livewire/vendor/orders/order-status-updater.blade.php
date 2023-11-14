<div>
    <div class="card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center">
                <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                <div class="flex-shrink-0 mt-2 mt-sm-0">
                    @if ($order->status == \App\Enums\Vendor\Orders\OrderStatus::PENDING)
                        <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::PENDING }}')"
                            class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i
                                class="ri-check-double-fill align-middle me-1"></i>Accept Order</button>
                        <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::CANCELLED }}')"
                            class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</button>
                    @elseif ($order->status == \App\Enums\Vendor\Orders\OrderStatus::ACCEPTED)
                        <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::ACCEPTED }}')"
                            class="btn btn-soft-primary btn-sm">Mark as Ready</button>
                        <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::CANCELLED }}')"
                            class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</button>
                    @elseif ($order->status == \App\Enums\Vendor\Orders\OrderStatus::READY)
                        @if ($order->order_type == \App\Enums\Vendor\Orders\OrderType::DELIVERY)
                            <button
                                onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::ASSIGNED_TO_DRIVER }}')"
                                class="btn btn-soft-warning btn-sm mt-2 mt-sm-0"><i
                                    class="ri-truck-line align-middle me-1"></i> Assign to Driver</button>
                        @else
                            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::DELIVERED }}')"
                                class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i
                                    class="ri-check-double-fill align-middle me-1"></i> Mark as Delivered</button>
                        @endif
                    @elseif ($order->status == \App\Enums\Vendor\Orders\OrderStatus::RIDER_PICKED_UP)
                        <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::DELIVERED }}')"
                            class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i
                                class="ri-check-double-fill align-middle me-1"></i> Mark as Delivered</button>
                    @endif

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="profile-timeline">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingOne">
                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <div class="avatar-title bg-success rounded-circle">
                                            <i class="ri-shopping-bag-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15 mb-0 fw-semibold">{{ $order->status_text }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body ms-2 ps-5 pt-0">
                                <h6 class="mb-1">An order has been placed.</h6>
                                <p class="text-muted">{{ $order->created_at->toDayDateTimeString() }}</p>

                            </div>
                        </div>
                    </div>
                </div><!--end accordion-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center" id="modalContent">
                    <!-- Dynamic Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!--end modal -->
</div>
@push('script')
    <script>
        function showModal(status) {
            let modalContent = '';

            switch (status) {
                case 'pending':
                    modalContent = `
                <h4>Accept Order</h4>
                <p>Are you sure you want to accept this order?</p>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-soft-success" onclick="updateOrderStatus('accepted')">Accept Order</button>
                    <button class="btn btn-soft-danger" onclick="updateOrderStatus('cancelled')">Cancel Order</button>
                </div>
            `;
                    break;

                case 'accepted':
                    modalContent = `
                <h4>Mark Order as Ready</h4>
                <p>Is the order ready for pickup?</p>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-soft-primary" onclick="updateOrderStatus('ready')">Mark as Ready</button>
                    <button class="btn btn-soft-danger" onclick="updateOrderStatus('cancelled')">Cancel Order</button>
                </div>
            `;
                    break;

                case 'ready':
                    modalContent = `
                <h4>Assign to Driver</h4>
                <p>Assign this order to a driver for delivery?</p>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-soft-warning" onclick="updateOrderStatus('assigned_to_driver')">Assign to Driver</button>
                </div>
            `;
                    break;

                case 'rider_picked_up':
                case 'delivered':
                    modalContent = `
                <h4>Mark as Delivered</h4>
                <p>Has the order been delivered?</p>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-soft-success" onclick="updateOrderStatus('delivered')">Mark as Delivered</button>
                </div>
            `;
                    break;

                default:
                    modalContent = `<p>Invalid action.</p>`;
            }

            document.getElementById('modalContent').innerHTML = modalContent;
            $('#statusUpdateModal').modal('show');
        }

        function updateOrderStatus(newStatus) {
            @this.call('updateOrderStatus', newStatus);
            $('#statusUpdateModal').modal('hide');
        }
    </script>
@endpush
