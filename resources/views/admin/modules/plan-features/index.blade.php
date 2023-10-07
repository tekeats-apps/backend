@extends('admin.layouts.main')
@section('title')
    Plan Features
@endsection
@push('css')
    @include('plugins.sweetalert2.css')
@endpush
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('admin.layouts.components.breadcrumb')
        @slot('li_1')
            Plan Features
        @endslot
        @slot('title')
            Manage Plan Features
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('admin.plans.feature-list')
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
                        Livewire.emit('delete-plan-feature', data.planFeatureId);
                    }
                });
            });

            Livewire.on('delete', function(data) {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "progressBar": true
                }
                toastr.success(data.message);
            });

            Livewire.on('exception', (data) => {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "progressBar": true
                }
                toastr.error(data.message);
            })
        });
    </script>
@endpush
