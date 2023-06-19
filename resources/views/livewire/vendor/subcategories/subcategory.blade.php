<div>
    @include('plugins.alerts.alerts')
    <div class="card">
        <div class="card-header border-bottom-dashed">

            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">Subcategories List</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <a type="button" href="{{ route('vendor.categories.subcategory.create') }}"
                            class="btn btn-success btn-label waves-effect waves-light"><i
                                class="ri-add-line label-icon align-middle fs-16 me-2"></i> Add New Subcategory</a>
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
                            placeholder="Search for category name, slug, or something...">
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
                        <th>Name</th>
                        <th>Featured</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($categories)
                        @foreach ($categories as $key => $category)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" id="category_{{ $category->id }}"
                                            type="checkbox" value="1">
                                    </div>
                                </th>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $category->image }}" alt=""
                                                class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                </td>

                                <td><span class="badge badge-soft-{{ $category->featured ? 'info' : 'danger' }}">
                                        {{ $category->featured ? 'Yes 🔥' : 'No ❌' }}</span></td>
                                <td><span class="badge badge-soft-primary">
                                        {{ $category->position ? $category->position : '-' }}</span></td>
                                <td><span class="badge badge-soft-{{ $category->status ? 'success' : 'danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('vendor.categories.subcategory.edit', [$categoryId, $category->id]) }}"
                                                    class="dropdown-item edit-item-btn" role="button"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                    Edit</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item remove-item-btn"
                                                    wire:click="confirmDelete({{ $category->id }})" role="button">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                    Delete
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item status-change-btn" role="button"
                                                    wire:click="toggleStatus({{ $category->id }})"
                                                    data-status="{{ $category->status }}">
                                                    <i
                                                        class="{{ $category->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                    {{ $category->status ? 'Deactivate' : 'Activate' }}
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
            <div class="d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
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
                        Livewire.emit('delete-category', data.categoryId);
                    }
                });
            });
        });
    </script>
</div>
