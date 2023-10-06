<div class="card" id="pluginTypeList">
    <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">Plugin Types</h5>
            <div class="flex-shrink-0">
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i
                            class="ri-delete-bin-2-line"></i></button>
                    <a href="{{ route('admin.plugin.types.create') }}" class="btn btn-success"><i
                            class="ri-add-line align-bottom me-1"></i> Create Type</a>
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
                        class="form-control search bg-light border-light" placeholder="Search for name or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
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
                        <th class="sort text-uppercase" scope="col">Type Name
                        </th>
                        <th class="text-uppercase" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($pluginTypes)
                        @foreach ($pluginTypes as $type)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="responsivetableCheck01">
                                        <label class="form-check-label" for="responsivetableCheck01"></label>
                                    </div>
                                </th>
                                <td>
                                    {{ $type?->name }}
                                </td>
                                <td>
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.plugin.types.edit', $type?->id) }}"
                                                data-id="{{ $type?->id }}">
                                                <i class="ri-edit-fill align-bottom me-2 text-muted"></i>
                                                Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" wire:click="confirmDelete('{{ $type?->id }}')"
                                                href="javascript:void(0);" data-id="">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                Delete</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            {{-- <div>
                {{ $plugins->links() }}
            </div> --}}
            @unless (count($pluginTypes))
                <div class="noresult">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                        </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched more than 150+ plugin types We
                            did not find any types for you search.</p>
                    </div>
                </div>
            @endunless

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
                            <h4>You are about to delete a plugin ?</h4>
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
