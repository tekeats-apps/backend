<div class="card">
    <div class="card-header border-bottom-dashed">

        <div class="row g-4 align-items-center">
            <div class="col-sm">
                <div>
                    <h5 class="card-title mb-0">Users List</h5>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex flex-wrap align-items-start gap-2">
                    <a type="button" href="{{ route('vendor.users.create') }}"
                        class="btn btn-success btn-label waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle fs-16 me-2"></i> Add User</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table nowrap align-middle datatable" style="width:100%">
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
                    <th>Role</th>
                    <th>Status</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @isset($users)
                    @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" id="user_{{ $user->id }}" type="checkbox"
                                        value="1">
                                </div>
                            </th>
                            <td>{{ ++$key }}</td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $user->image }}" alt="" class="avatar-xs rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge  badge-soft-info text-capitalize">
                                    {{ $user->roles->pluck('name')->first() }}</span></td>
                            <td><span class="badge badge-soft-{{ $user->status ? 'success' : 'danger' }}">
                                    {{ $user->statusText }}</span></td>
                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                            @if (Auth::guard('vendor')->user()->id != $user->id)
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('vendor.users.edit', $user->id) }}"
                                                    class="dropdown-item edit-item-btn"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-info"></i>
                                                    Edit</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item remove-item-btn">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                    Delete
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item status-change-btn"
                                                    data-status="{{ $user->status }}" wire:click="toggleStatus({{ $user->id }})">
                                                    <i class="{{ $user->status ? 'ri-arrow-down-fill text-danger' : 'ri-arrow-up-fill text-success' }} align-bottom me-2"></i>
                                                    {{ $user->status ? 'Deactivate' : 'Activate' }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>
