document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    const form = document.getElementById('forgotPasswordForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Clear any previous messages
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.innerHTML = '';

        // Create FormData object from the form
        const formData = new FormData(form);

        // Send the form data using fetch
        fetch('./admin/forgetpass.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            // Display success or error message
            if (data.status === 'success') {
                messageContainer.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            } else {
                messageContainer.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            // Handle errors
            messageContainer.innerHTML = `<div class="alert alert-danger">There was an error processing your request. Please try again later.</div>`;
        });
    });
});
