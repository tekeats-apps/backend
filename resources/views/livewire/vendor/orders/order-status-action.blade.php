<div>
    <div class="flex-shrink-0 mt-2 mt-sm-0">
        @if ($order->canBeAccepted())
            <!-- Display Accept button -->
            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::PENDING }}')"
                class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i
                    class="ri-check-double-fill align-middle me-1"></i>Accept Order</button>
        @endif

        @if ($order->canBeMarkedAsReady())
            <!-- Display Mark as Ready button -->
            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::ACCEPTED }}')"
                class="btn btn-soft-primary btn-sm">Mark as Ready</button>
        @endif

        @if ($order->canBeAssignedToDriver())
            <!-- Display Assign to Driver button -->
            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::ASSIGNED_TO_DRIVER }}')"
                class="btn btn-soft-warning btn-sm mt-2 mt-sm-0"><i class="ri-truck-line align-middle me-1"></i> Assign to
                Driver</button>
        @endif

        @if ($order->canBeMarkedAsDelivered())
            <!-- Display Mark as Delivered button -->
            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::DELIVERED }}')"
                class="btn btn-soft-success btn-sm mt-2 mt-sm-0"><i class="ri-check-double-fill align-middle me-1"></i>
                Mark as Delivered</button>
        @endif

        @if ($order->canBeCancelled())
            <!-- Display Cancel button -->
            <button onclick="showModal('{{ \App\Enums\Vendor\Orders\OrderStatus::CANCELLED }}')"
                class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                    class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</button>
        @endif
    </div>
    <div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5 text-center" id="modalContent">
                </div>
            </div>
        </div>
    </div>
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
                </div>Status
            `;
                    break;

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

                case 'cancelled':
                    modalContent = `
                <h4>Mark as Cancelled</h4>
                <p>Has the order been cancelled?</p>
                <div class="hstack gap-2 justify-content-center">
                    <button class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-soft-danger" onclick="updateOrderStatus('cancelled')">Mark as Cancelled</button>
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
            try {
                @this.call('updateOrderStatus', newStatus);
                // On success, update UI and hide spinner
            } catch (error) {
                console.log("🚀 ~ file: order-status-updater.blade.php:198 ~ updateOrderStatus ~ error:", error)
                // On error, show error message and hide spinner
            } finally {
                // Re-enable button and hide modal
                $('#statusUpdateModal').modal('hide');
            }
        }
    </script>
@endpush
