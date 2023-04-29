@extends('store.layouts.main')
@push('css')
    @include('store.layouts.components.plugins.filepond.css');
@endpush
@section('title')
    @lang('translation.users')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('store.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent

    <form id="users-form" action="{{ route('store.users.update', $user->id) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User Information <span class="float-end">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#changeUserPassword" class="btn btn-warning btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-lock-password-line label-icon"></i>Change Password</a>
                                {{-- <a href="{{ route('store.users.create') }}"
                                    class="btn btn-primary btn-label bt-sm waves-effect waves-light"><i
                                        class="ri-folder-lock-line label-icon"></i> Permissions</a> --}}
                                <a href="{{ route('store.users.list') }}"
                                    class="btn btn-info btn-label bt-sm waves-effect waves-light"> <i
                                        class="ri-arrow-go-back-line label-icon"></i>Back to Users </a>

                            </span></h5>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') ? old('name') : $user->name }}" placeholder="Enter name"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username" value="{{ old('username') ? old('username') : $user->username }}"
                                        placeholder="Enter username" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email"
                                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ old('email') ? old('email') : $user->email }}"
                                        placeholder="Enter unique email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select {{ $errors->has('role') ? ' is-invalid' : '' }}"
                                        name="role">
                                        <option value="" selected>Select role for user</option>
                                        @isset($roles)
                                            @foreach ($roles as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ (old('role') ? old('role') : $userRole->id == $id) ? 'selected' : '' }}>
                                                    {{ ucfirst($name) }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User Status & Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-2">User Profile Image</h5>
                            <div class="avatar-xl mx-auto">
                                <input type="file"
                                    class="filepond filepond-input-circle {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                    name="image" accept="image/png, image/jpeg, image/gif" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="choices-publish-status-input" data-choices
                                data-choices-search-false>
                                <option {{ $user->status == 1 ? 'selected' : '' }} value="1" selected>Active</option>
                                <option {{ $user->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
        </div>
        <!-- end row -->
    </form>
    @include('store.modules.users.change-password')
@endsection
@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    @include('store.layouts.components.plugins.filepond.js')
    <script>
        $().ready(function() {
            // validate signup form on keyup and submit
            $("#users-form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    username: {
                        required: true,
                        minlength: 5
                    },
                    role: {
                        required: true
                    }

                },
                messages: {
                    name: "Please enter user full name",
                    email: "Please enter a valid email address",
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 5 characters"
                    },
                    role: "Please select role for user"
                }
            });
            FilePond.create(
                document.querySelector('.filepond-input-circle'), {
                    labelIdle: 'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                    stylePanelLayout: 'compact circle',
                    styleLoadIndicatorPosition: 'center bottom',
                    styleProgressIndicatorPosition: 'right bottom',
                    styleButtonRemoveItemPosition: 'left bottom',
                    styleButtonProcessItemPosition: 'right bottom',
                }
            );
        });
    </script>
@endpush
