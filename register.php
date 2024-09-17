<?php
$pageTitle = "Register Page";
include('includes/header.php');
include('includes/config.php');
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repeat_password']) && isset($_POST['name'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $name = $conn->real_escape_string($_POST['name']);

        // Check if passwords match
        if ($password !== $repeat_password) {
            echo "Passwords do not match.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert the user into the database
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);


            if ($stmt->execute()) {
                // Registration successful
                $_SESSION['registration_success'] = true; // Optional: set a session variable for success message
                header("Location: ./login.php"); // Redirect to login page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        echo "Required fields are missing.";
    }

    $conn->close();
}
?>

<style>
    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }

    .form-container {
        width: 100%;
        max-width: 600px;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    /* Container for password input and icon */
    .password-container {
        position: relative;
        width: 100%;
    }

    /* Style the password input */
    .password-container input {
        width: 100%;
        padding-right: 45px;
        /* Space for the eye icon */
        box-sizing: border-box;
        /* Ensure padding doesn't break the layout */
    }

    /* Style the eye icon */
    .password-container .password-toggle {
        position: absolute;
        right: 10px;
        /* Adjust to place it inside the input field */
        top: 50%;
        transform: translateY(-50%);
        /* Center vertically */
        cursor: pointer;
        color: #888;
        /* Adjust color */
        font-size: 1.2em;
        /* Adjust size */
    }

    /* Make sure the form fields maintain consistent padding */
    .password-container input:focus {
        outline: none;
        border-color: #007bff;
    }
</style>

<form method="post" action="">
    <!-- Centered Form in a Box -->
    <div class="form-container card">
        <div style="display:block;">
            <div style="display: flex;">
                <div style="margin-left: -50px; cursor: pointer;">
                    <button type="button" class="btn btn-link btn-floating mx-1" style="padding-right: 5px;"
                        onclick="window.location.href='./index.php';">
                        <i class="fa-solid fa-arrow-left" style="font-size: 16px;"></i>
                    </button>
                </div>
                <div style="flex-grow: 1">
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist" style="margin-top: 9px;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="tab-login" href="./login.php" role="tab"
                                aria-controls="pills-login" aria-selected="false">Login</a>
                        </li>
                        <li class=" nav-item" role="presentation">
                            <a class="nav-link active" id="tab-register" href="#" role="tab"
                                aria-controls="pills-register" aria-selected="true">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Name input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="registerName">Name</label>
            <input type="text" id="registerName" name="name" class="form-control" required />
        </div>

        <!-- Username input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="registerUsername">Username</label>
            <input type="text" id="registerUsername" name="username" class="form-control" required />
        </div>

        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="registerEmail">Email</label>
            <input type="email" id="registerEmail" name="email" class="form-control" required />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="registerPassword">Password</label>
            <input type="password" id="registerPassword" name="password" class="form-control" required />
        </div>


        <div class="form-outline mb-4">
            <label class="form-label" for="registerRepeatPassword">Repeat password</label>
            <div class="password-container">
                <input type="password" id="registerRepeatPassword" name="repeat_password" class="form-control"
                    required />
                <i class="fas fa-eye password-toggle" id="toggleRepeatPassword"></i>
            </div>
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex mb-4">
            <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck"
                aria-describedby="registerCheckHelpText" required />
            <label class="form-check-label" for="registerCheck">
                I have read and agree to the terms
            </label>
        </div>

        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init
            class="btn btn-primary btn-block mb-3">Register</button>
</form>

<!-- JavaScript for toggling the password visibility -->
<script>
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
</script>

</body>

</html>