document.addEventListener('DOMContentLoaded', function () {
    // Get the password fields and their respective toggle icons
    const loginPasswordField = document.getElementById('loginPassword');
    const toggleLoginPasswordIcon = document.getElementById('togglePassword');
    // Add event listener for the login password toggle
    if (toggleLoginPasswordIcon) {
        toggleLoginPasswordIcon.addEventListener('click', function () {
            if (loginPasswordField.type === 'password') {
                loginPasswordField.type = 'text';
                toggleLoginPasswordIcon.classList.remove('fa-eye');
                toggleLoginPasswordIcon.classList.add('fa-eye-slash');
            } else {
                loginPasswordField.type = 'password';
                toggleLoginPasswordIcon.classList.remove('fa-eye-slash');
                toggleLoginPasswordIcon.classList.add('fa-eye');
            }
        });
    }
});
