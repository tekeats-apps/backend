@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show" id="success-alert" role="alert">
        <i class="ri-user-smile-line label-icon"></i><strong>Success</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show" role="alert" id="error-alert">
        <i class="ri-error-warning-line label-icon"></i><strong>Danger</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
