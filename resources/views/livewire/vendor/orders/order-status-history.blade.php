<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                <div class="flex-shrink-0">
                    <div wire:loading class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="profile-timeline">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <!-- Loop through each status history record -->
                    @foreach ($orderStatusHistory as $index => $statusHistory)
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="heading{{ $index }}">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                    href="#collapse{{ $index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $index }}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="ri-shopping-bag-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-15 mb-0 fw-semibold">{{ $statusHistory->status_text }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse{{ $index }}" class="accordion-collapse"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body ms-2 ps-5 pt-0">
                                    <h6 class="mb-1">Status updated to: {{ $statusHistory->status_text }}</h6>
                                    <p class="text-muted">{{ $statusHistory->created_at->toDayDateTimeString() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!--end accordion-->
            </div>

        </div>
    </div>
</div>
