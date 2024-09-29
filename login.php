<?php
$pageTitle = "Login Page"; // Title of the page
include('includes/header.php'); // Include the header
include('includes/config.php'); // Include database configuration
?>

<?php
// Initialize error messages
$emailError = $passwordError = $generalError = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate email and password fields
        if (empty($email)) {
            $emailError = "Email is required.";
        }
        if (empty($password)) {
            $passwordError = "Password is required.";
        }

        // If no validation errors, proceed with login
        if (empty($emailError) && empty($passwordError)) {
            // Prepare the SQL query to prevent SQL injection
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email); // Bind the email parameter
            $stmt->execute(); // Execute the prepared statement
            $result = $stmt->get_result(); // Get the result set

            // Check if any user is found with the provided email
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Fetch the user data
                // Verify the password
                if (password_verify($password, $row['password'])) {
                    // Start a new session and store user data
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['login'] = true;

                    // Redirect based on user type
                    if ($row['user_type'] === 'teacher') {
                        header("Location: ./teacher/dashboard.php");
                    } elseif ($row['user_type'] === 'student') {
                        header("Location: ./student/dashboard.php");
                    } else {
                        $generalError = "Invalid user type.";
                    }
                    exit(); // Terminate the script after redirect
                } else {
                    $passwordError = "Incorrect password!";
                }
            } else {
                $emailError = "No user found with this email!";
            }

            $stmt->close(); // Close the statement
        }
    } else {
        $generalError = "Required fields are missing.";
    }

    $conn->close(); // Close the database connection
}
?>

<style>
    /* Styles for the login page */
    body,
    html {
        height: 100%;
        /* Full height */
        margin: 0;
        /* Remove default margin */
        display: flex;
        /* Use flexbox for centering */
        justify-content: center;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
        background-color: #f8f9fa;
        /* Light background color */
    }

    .form-container {
        width: 100%;
        max-width: 600px;
        /* Maximum width of the form */
        padding: 30px;
        /* Padding inside the form */
        background-color: white;
        /* White background for the form */
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
    }

    .password-container {
        position: relative;
        /* Position for password visibility toggle */
        width: 100%;
    }

    .password-container input {
        width: 100%;
        /* Full width for input */
        padding-right: 45px;
        /* Space for toggle icon */
        box-sizing: border-box;
        /* Include padding in width */
    }

    .password-container .password-toggle {
        position: absolute;
        /* Positioning for toggle icon */
        right: 10px;
        /* Align to the right */
        top: 50%;
        /* Center vertically */
        transform: translateY(-50%);
        /* Adjust vertical alignment */
        cursor: pointer;
        /* Change cursor on hover */
        color: #888;
        /* Color for the icon */
        font-size: 1.2em;
        /* Icon size */
    }

    .password-container input:focus {
        outline: none;
        /* Remove outline */
        border-color: #007bff;
        /* Change border color on focus */
    }
</style>

<body>
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
                                <a class="nav-link active" id="tab-login" href="#pills-login" role="tab"
                                    aria-controls="pills-login" aria-selected="true">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-register" href="./register.php" role="tab"
                                    aria-controls="pills-register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Email Input Field -->
            <div class="form-outline mb-4">
                <label class="form-label" for="loginEmail">Email</label>
                <input type="email" id="loginEmail" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required />
                <?php if ($emailError): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($emailError); ?></div>
                <?php endif; ?>
            </div>

            <!-- Password Input Field -->
            <div class="form-outline mb-4">
                <label class="form-label" for="loginPassword">Password</label>
                <div class="password-container">
                    <input type="password" id="loginPassword" name="password" class="form-control" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
                <?php if ($passwordError): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($passwordError); ?></div>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

            <div class="text-center">
                <p>Not a member? <a href="./register.php">Register</a></p>
            </div>
        </div>
    </form>

    <script>
        // JavaScript for toggling password visibility
        document.addEventListener('DOMContentLoaded', function () {
            const loginPasswordField = document.getElementById('loginPassword');
            const toggleLoginPasswordIcon = document.getElementById('togglePassword');
            if (toggleLoginPasswordIcon) {
                toggleLoginPasswordIcon.addEventListener('click', function () {
                    // Toggle between password and text input
                    if (loginPasswordField.type === 'password') {
                        loginPasswordField.type = 'text'; // Show password
                        toggleLoginPasswordIcon.classList.remove('fa-eye');
                        toggleLoginPasswordIcon.classList.add('fa-eye-slash'); // Change icon
                    } else {
                        loginPasswordField.type = 'password'; // Hide password
                        toggleLoginPasswordIcon.classList.remove('fa-eye-slash');
                        toggleLoginPasswordIcon.classList.add('fa-eye'); // Change icon back
                    }
                });
            }
        });
    </script>
</body>

</html>