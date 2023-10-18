@yield('on-top-css')
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

@livewireStyles

<style>
    .required::after {
        content: " *" !important;
        color: #c00 !important;
    }
    .back {
        font-size: 1.1rem;
    }
</style>
@stack('css')
