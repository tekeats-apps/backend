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
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge  badge-soft-info text-capitalize">
                                    {{ $user->roles->pluck('name')->first() }}</span></td>
                            <td><span class="badge badge-soft-{{ $user->status ? 'success' : 'danger' }}">
                                    {{ $user->statusText }}</span></td>
                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="{{ route('vendor.users.edit', $user->id) }}"
                                                class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Edit</a>
                                        </li>
                                        @if (Auth::guard('vendor')->user()->id != $user->id)
                                            <li>
                                                <a class="dropdown-item remove-item-btn">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        @endif
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
