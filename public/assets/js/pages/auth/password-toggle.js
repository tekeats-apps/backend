document.addEventListener('DOMContentLoaded', function () {
    var passwordInput = document.getElementById('password-input');
    var passwordAddon = document.getElementById('password-addon');

    passwordAddon.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordAddon.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
        } else {
            passwordInput.type = 'password';
            passwordAddon.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
        }
    });
});
