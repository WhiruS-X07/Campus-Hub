document.addEventListener('DOMContentLoaded', function () {
    const repeatPasswordField = document.getElementById('registerRepeatPassword');
    const toggleRepeatPasswordIcon = document.getElementById('toggleRepeatPassword');

    // Add event listener for the repeat password toggle
    if (toggleRepeatPasswordIcon) {
        toggleRepeatPasswordIcon.addEventListener('click', function () {
            if (repeatPasswordField.type === 'password') {
                repeatPasswordField.type = 'text';
                toggleRepeatPasswordIcon.classList.remove('fa-eye');
                toggleRepeatPasswordIcon.classList.add('fa-eye-slash');
            } else {
                repeatPasswordField.type = 'password';
                toggleRepeatPasswordIcon.classList.remove('fa-eye-slash');
                toggleRepeatPasswordIcon.classList.add('fa-eye');
            }
        });
    }
});
