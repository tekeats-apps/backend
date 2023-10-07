@extends('admin.layouts.main')
@section('title')
    Plugin Types
@endsection
@push('css')
    @include('plugins.sweetalert2.css')
@endpush
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plugin Types
        @endslot
        @slot('title')
            Manage Plugin Types
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        @if (session('error'))
            <div class="mx-3 text-danger">{{ session('error') }}</div>
        @endif
        <div class="col-lg-12">
            @livewire('admin.plugins.plugin-type')
        </div>
        <!--end col-->
    </div>
@endsection
@push('script')
    @include('plugins.sweetalert2.js')
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
                        Livewire.emit('delete-plugin-type', data.pluginTypeId);
                    }
                });
            });
        });
    </script>
@endpush
