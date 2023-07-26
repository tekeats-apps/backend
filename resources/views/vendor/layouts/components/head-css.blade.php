<!-- Layout config Js -->
<script src="{{ URL::asset('assets/js/layout.js') }}"></script>


<!-- Bootstrap Css -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- Icons Css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('assets/css/custom.min.css') }}" id="custom-style" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .dropify-wrapper .dropify-message p {
        font-family: 'dropify' !important;
        font-size: 30px !important;
    }
</style>

@livewireStyles

@stack('css')
