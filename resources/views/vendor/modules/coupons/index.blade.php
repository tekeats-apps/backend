@extends('vendor.layouts.main')
@section('title')
    Coupons
@endsection
@push('css')
    @include('plugins.sweetalert2.css')
@endpush
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            Coupons
        @endslot
        @slot('title')
            Manage Coupons
        @endslot
    @endcomponent
    {{-- Main Content --}}
    <div class="row">
        <div class="col-lg-12">
            @livewire('vendor.coupons.coupon-list')
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
                        Livewire.emit('delete', data.id);
                    }
                });
            });
        });

        document.addEventListener('alert', ({
            detail
        }) => {
            toastr.options = {
                "closeButton": true,
                "preventDuplicates": true,
                "progressBar": true
            }
            toastr[detail.type](detail.message)
        });
    </script>
@endpush
