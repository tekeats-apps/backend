<div class="card" id="planSubscriptionsList">
    <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">Subscription Plans</h5>
            <div class="flex-shrink-0">
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i
                            class="ri-delete-bin-2-line"></i></button>
                    <a href="{{ route('admin.plans.subscriptions.create') }}" class="btn btn-success"><i
                            class="ri-add-line align-bottom me-1"></i> Create Subscription Plan</a>
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
                        placeholder="Search for name, description, price or something...">
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
                        <th class="sort text-uppercase" scope="col">Plan Name
                        </th>
                        <th class="sort text-uppercase" scope="col">Duration</th>
                        <th class="sort text-uppercase" scope="col">Price</th>
                        <th class="text-uppercase" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($planSubscriptions)
                        @foreach ($planSubscriptions as $planSubscription)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="responsivetableCheck01">
                                        <label class="form-check-label" for="responsivetableCheck01"></label>
                                    </div>
                                </th>
                                <td>
                                    {{ $planSubscription?->name }}
                                </td>
                                <td>

                                    <span class="badge badge-soft-success">
                                        {{ $planSubscription?->invoice_period }} {{ strtoupper($planSubscription?->invoice_interval) }}</span>
                                </td>
                                <td>
                                    {{ $planSubscription?->price }} {{ $planSubscription?->currency }}
                                </td>
                                <td>
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.plans.subscriptions.edit', $planSubscription?->id) }}"
                                                data-id="{{ $planSubscription?->id }}">
                                                <i class="ri-edit-fill align-bottom me-2 text-muted"></i>
                                                Edit</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.plans.subscriptions.show', $planSubscription?->id) }}"
                                                data-id="{{ $planSubscription?->id }}">
                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                View</a></li>
                                        <li>
                                            <a class="dropdown-item"
                                                wire:click="confirmDelete('{{ $planSubscription?->id }}')"
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
                {{ $planSubscriptions->links() }}
            </div> --}}
            @unless (count($planSubscriptions))
                <div class="noresult">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                        </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched more than 150+ plugins We
                            did not find any
                            plugins for you search.</p>
                    </div>
                </div>
            @endunless

            <!-- end table -->
        </div>
        <!-- end table responsive -->
    </div>
</div>
