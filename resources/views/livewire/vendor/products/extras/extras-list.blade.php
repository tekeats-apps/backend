<div>
    @include('plugins.alerts.alerts')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"> Product Extras | Addons<span class="float-end">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#extrasModal"
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
                        @isset($extras)
                            @foreach ($extras as $key => $extra)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" id="extra_{{ $extra->id }}"
                                                type="checkbox" value="1">
                                        </div>
                                    </th>

                                    <td>
                                        {{ $extra->name }}
                                    </td>
                                    <td>{{ $extra->price }}</td>
                                    <td><span class="badge badge-soft-{{ $extra->status ? 'success' : 'danger' }}">
                                            {{ $extra->status ? 'Active' : 'Inactive' }}</span></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="#" wire:click.prevent="edit({{ $extra->id }})"
                                                        class="dropdown-item edit-item-btn" role="button"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                        Edit</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item remove-item-btn"
                                                        wire:click="confirmDelete({{ $extra->id }})" role="button">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item status-change-btn" role="button"
                                                        wire:click="toggleStatus({{ $extra->id }})"
                                                        data-status="{{ $extra->status }}">
                                                        <i
                                                            class="{{ $extra->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                        {{ $extra->status ? 'Deactivate' : 'Activate' }}
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
                        Livewire.emit('delete-extra', data.extraId);
                    }
                });
            });
        });
    </script>
@endpush
