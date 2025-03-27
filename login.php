<?php
// Including header and configuration files for setting up the environment and connecting to the database
include('includes/header.php');
include('includes/config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$error_message = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];

        // Check if email exists
        $stmt = $conn->prepare("SELECT id, name, password, user_type FROM users_info WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $user_name, $stored_password, $user_type);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $stored_password)) {
                // Start session and store user information
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = $user_type;

                // Redirect to appropriate dashboard
                if ($user_type === 'teacher') {
                    header("Location: teacher/dashboard.php");
                } else {
                    header("Location: student/dashboard.php");
                }
                exit;
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "No user found with this email address.";
        }
    } else {
        $error_message = "Please enter both email and password.";
    }
}
?>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <form class="card p-5 shadow-lg" style="width: 100%; max-width: 500px; border-radius: 20px;" method="post"
            action="login.php">
            <div class="form-container text-center mb-4">
                <h3 class="fw-bold">Welcome Back!</h3>
                <p class="text-muted">Login to access your dashboard</p>
            </div>

            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger text-center" role="alert"><?php echo $error_message; ?></div>
            <?php } ?>

            <!-- Email -->
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input type="email" id="loginEmail" name="email" class="form-control" placeholder="Enter your email"
                    required />
            </div>

            <!-- Password with Toggle -->
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="loginPassword" name="password" class="form-control"
                        placeholder="Enter your password" required />
                    <span class="input-group-text">
                        <input type="checkbox" onclick="togglePassword()" id="showPassword"> Show
                    </span>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>

            <div class="text-center mt-3">
                <p>Don't have an account? <a href="./register.php">Register here</a>.</p>
                <a href="index.php" class="text-muted">&larr; Back to Home</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("loginPassword");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>
</body>

</html>