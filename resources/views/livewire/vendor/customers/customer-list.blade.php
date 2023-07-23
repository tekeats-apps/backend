<div>
    <div class="card">
        <div class="card-header border-bottom-dashed">
            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                        <h5 class="card-title mb-0">Customers List</h5>
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
                            placeholder="Search for customer name, email, role, status or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <label for="status"> Status</label>
                    <div class="input-light" wire:ignore>
                        <select class="form-control" wire:model.debounce.500ms="status" data-choices
                            data-choices-search-false>
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $key => $customer)
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" id="customer_{{ $customer->id }}"
                                        type="checkbox" value="1">
                                </div>
                            </th>
                            <td>{{ ++$key }}</td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $customer->avatar }}" alt=""
                                            class="avatar-xs rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        {{ $customer->fullName }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td><span class="badge badge-soft-{{ $customer->status ? 'success' : 'danger' }}">
                                    {{ $customer->statusText }}</span></td>
                            <td>{{ $customer->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{-- <li><a href="{{ route('vendor.customers.edit', $customer->id) }}"
                                                class="dropdown-item edit-item-btn" role="button"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                Edit</a>
                                        </li> --}}
                                        {{-- <li>
                                            <a class="dropdown-item remove-item-btn" role="button">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                Delete
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a class="dropdown-item status-change-btn" role="button"
                                                wire:click="toggleStatus({{ $customer->id }})"
                                                data-status="{{ $customer->status }}">
                                                <i
                                                    class="{{ $customer->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                {{ $customer->status ? 'Deactivate' : 'Activate' }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @unless (count($customers))
                <div class="noresult">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                        </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched our all records
                            did not find any
                            customer details for you search.</p>
                    </div>
                </div>
            @endunless
            <div class="d-flex justify-content-end">
                {{ $customers->links() }}
            </div>
        </div>
    </div>

</div>
