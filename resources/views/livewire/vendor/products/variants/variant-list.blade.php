<div>
    @include('plugins.alerts.alerts')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"> Product Variants | Sizes <span class="float-end">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#variantsModal"
                            class="btn btn-primary bt-sm">Add
                            New</button>
                    </span></h5>
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
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($variants)
                            @foreach ($variants as $key => $variant)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" id="variant_{{ $variant->id }}"
                                                type="checkbox" value="1">
                                        </div>
                                    </th>

                                    <td>
                                        {{ $variant->name }}
                                    </td>
                                    <td>{{ $variant->price }}</td>
                                    <td><span class="badge badge-soft-{{ $variant->status ? 'success' : 'danger' }}">
                                            {{ $variant->status ? 'Active' : 'Inactive' }}</span></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="#" wire:click.prevent="edit({{ $variant->id }})"
                                                        class="dropdown-item edit-item-btn" role="button"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                        Edit</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item remove-item-btn"
                                                        wire:click="confirmDelete({{ $variant->id }})" role="button">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item status-change-btn" role="button"
                                                        wire:click="toggleStatus({{ $variant->id }})"
                                                        data-status="{{ $variant->status }}">
                                                        <i
                                                            class="{{ $variant->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                        {{ $variant->status ? 'Deactivate' : 'Activate' }}
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
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('swal:confirm-delete', function(data) {
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('delete-variant', data.variantId);
                    }
                });
            });
        });
    </script>
@endpush
