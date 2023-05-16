@extends('admin.layouts.main')
@push('css')
    @include('admin.layouts.components.plugins.datatable.datatables-css')
@endpush
@section('title')
    @lang('translation.roles')
@endsection
@section('content')

    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.roles')
        @endslot
        @slot('title')
            @lang('translation.manage-roles')
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom-dashed">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>
                                <h5 class="card-title mb-0">Roles List</h5>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex flex-wrap align-items-start gap-2">
                                <a type="button" href="{{ route('admin.roles.create') }}"
                                    class="btn btn-success btn-label waves-effect waves-light"><i
                                        class="ri-add-line label-icon align-middle fs-16 me-2"></i> Add New Role</a>
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
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($roles)
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" id="role_{{ $role->id }}"
                                                    type="checkbox" value="1">
                                            </div>
                                        </th>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td>{{ $role->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
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
        <!--end col-->
    </div>
@endsection
@push('script')
    @include('admin.layouts.components.plugins.datatable.datatables-js')
@endpush
