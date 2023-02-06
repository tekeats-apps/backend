@extends('admin.layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endpush
@section('title')
    @lang('translation.users')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent

    <form id="users-form" autocomplete="off" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name') ? old('name') : $user->name }}" placeholder="Enter name"
                                        required>
                                    <div class="invalid-feedback">Please enter a name.</div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ old('username') ? old('username') : $user->username }}"
                                        placeholder="Enter username">
                                    <div class="invalid-feedback">Please enter unique username.</div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select mb-3">
                                        <option selected>Select role for user</option>
                                        @isset($roles)
                                            @foreach ($roles as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <div class="invalid-feedback">Please select role for user.</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <input type="file" class="filepond filepond-input-circle" name="filepond"
                                    accept="image/png, image/jpeg, image/gif" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" id="choices-publish-status-input" data-choices
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
@endsection
@push('script')
    <script src="{{ URL::asset('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script>
        // FilePond
        FilePond.registerPlugin(
            // encodes the file as base64 data
            FilePondPluginFileEncode,
            // validates the size of the file
            FilePondPluginFileValidateSize,
            // corrects mobile image orientation
            FilePondPluginImageExifOrientation,
            // previews dropped images
            FilePondPluginImagePreview
        );

        var inputMultipleElements = document.querySelectorAll('input.filepond-input-multiple');
        if (inputMultipleElements) {

            // loop over input elements
            Array.from(inputMultipleElements).forEach(function(inputElement) {
                // create a FilePond instance at the input element location
                FilePond.create(inputElement);
            })

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
        }
    </script>
@endpush
