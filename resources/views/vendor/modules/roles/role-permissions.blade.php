@extends('vendor.layouts.main')
@section('title')
    @lang('translation.roles')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.roles')
        @endslot
        @slot('title')
            @lang('translation.manage-roles')
        @endslot
    @endcomponent

    <form id="role-permissions-form" action="{{ route('vendor.roles.update.permissions', $role->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->has('permissions'))
                    <div class="alert alert-danger">{{ $errors->first('permissions') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Role Permissions <span class="float-end">
                                <a type="button" href="{{ route('vendor.roles.sync.permissions') }}"
                                    class="btn btn-info btn-label waves-effect waves-light"><i
                                        class="ri-secure-payment-line label-icon align-middle fs-16 me-2"></i> Sync
                                    Permissions List</a>
                                <a href="{{ route('vendor.roles.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Roles </a>

                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch form-switch-custom form-switch-success mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="select-all-checkbox">
                            <label class="form-check-label" for="select-all-checkbox">Select All</label>
                        </div>


                        @forelse ($permissions as $module => $modulePermissions)
                            <div class="mt-3">
                                <h5 class="card-header heading-smal text-white mb-4 card-info">{{ $module }}</h5>
                                <div class="row">
                                    @foreach ($modulePermissions as $permission)
                                        <div class="col-lg-2 col-md-2">
                                            <div class="form-check form-check-success mb-3">
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" value="{{ $permission['name'] }}"
                                                    {{ in_array($permission['id'], $active_permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="formCheck8">
                                                    {{ ucwords(str_replace('-', ' ', $permission['name'])) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p>No permissions found.</p>
                        @endforelse
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>
        <!-- end row -->
    </form>
@endsection
@push('script')
    <script>
        const selectAllCheckbox = document.querySelector('#select-all-checkbox');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        selectAllCheckbox.addEventListener('change', (event) => {
            permissionCheckboxes.forEach((checkbox) => {
                checkbox.checked = event.target.checked;
            });
        });

        permissionCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                const allChecked = Array.from(permissionCheckboxes).every((permissionCheckbox) =>
                    permissionCheckbox.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });

        // Check if all permission checkboxes are checked on page load
        const allChecked = Array.from(permissionCheckboxes).every((permissionCheckbox) => permissionCheckbox.checked);
        selectAllCheckbox.checked = allChecked;
    </script>
@endpush
