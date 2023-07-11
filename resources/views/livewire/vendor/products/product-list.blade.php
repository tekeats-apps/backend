<div>
    @include('plugins.alerts.alerts')
    <div class="card">
        <div class="card-header border-bottom-dashed">
            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">Products List</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <a type="button" href="{{ route('vendor.products.create') }}"
                            class="btn btn-success btn-label waves-effect waves-light"><i
                                class="ri-add-line label-icon align-middle fs-16 me-2"></i> Add New Product</a>
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
                            placeholder="Search for product name, slug, or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
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
                        <th>SR No.</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($products)
                        @foreach ($products as $key => $product)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" id="category_{{ $product->id }}"
                                            type="checkbox" value="1">
                                    </div>
                                </th>
                                <td>{{ ++$key }}</td>

                                <td> {{ $product->category->name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $product->image }}" alt=""
                                                class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                        {{ $product->price ? $product->price : '-' }}</td>
                                <td><span class="badge badge-soft-{{ $product->featured ? 'info' : 'danger' }}">
                                        {{ $product->featured ? 'Yes 🔥' : 'No ❌' }}</span></td>

                                <td><span class="badge badge-soft-{{ $product->status ? 'success' : 'danger' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('vendor.products.edit', $product->id) }}"
                                                    class="dropdown-item edit-item-btn" role="button"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                    Edit</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item remove-item-btn"
                                                    wire:click="confirmDelete({{ $product->id }})" role="button">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                    Delete
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item status-change-btn" role="button"
                                                    wire:click="toggleStatus({{ $product->id }})"
                                                    data-status="{{ $product->status }}">
                                                    <i
                                                        class="{{ $product->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                    {{ $product->status ? 'Deactivate' : 'Activate' }}
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
            @isset($products)
                <div class="d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            @endisset
        </div>
    </div>
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
                        Livewire.emit('delete-product', data.productId);
                    }
                });
            });
        });
    </script>
</div>
