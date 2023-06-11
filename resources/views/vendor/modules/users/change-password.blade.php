<div class="modal fade" id="changeUserPassword" tabindex="-1" aria-labelledby="changeUserPasswordLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeUserPasswordLabel">Change User Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vendor.users.password.update', $user->id) }}" method="POST" id="password-update-form">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                        <!--end col-->
                        <div class="col-xxl-12">
                            <div>
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="password_confirmation" class="form-label">Confirm new Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ URL::asset('assets/libs/validation/validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // validate signup form on keyup and submit
            $("#password-update-form").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    password_confirmation: {
                        required: "Please provide a password confirmation",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo: "Please enter the same password"
                    }
                }
            });

            $('#changeUserPassword').on('hidden.bs.modal', function() {
                $("#password-update-form").validate().resetForm();
                $(".error").removeClass("error");
                $(this).find('form').trigger('reset');
            })


            $("#password-update-form").validate({
                submitHandler: function(form) {
                    $(form).ajaxSubmit();
                }
            });
        });
    </script>
@endpush
